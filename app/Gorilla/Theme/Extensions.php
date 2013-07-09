<?php namespace Gorilla\Theme;

use Twig_SimpleTest;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use Twig_ExpressionParser;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class Extensions extends \TwigBridge\Extension
{
	protected $app;
	protected $tags;
	protected $theme;

	public function __construct()
	{
		$this->app    = app();
		$this->tags   = new Tags;
		$this->theme  = $this->app['gorilla.theme'];
	}

	/**
	 * Name
	 */
	public function getName()
	{
		return 'Gorilla Tags';
	}

	/**
	 * Globals
	 */
	public function getGlobals()
	{
		return array(
			'theme'   => $this->theme,
			'gorilla' => $this->tags,
		);
	}

	/**
	 * Filters
	 */
	public function getFilters()
	{
		return array(
			new Twig_SimpleFilter('dump',     array($this, 'twig_filter_dump')),
			new Twig_SimpleFilter('words',    array($this, 'twig_filter_words')),
			new Twig_SimpleFilter('truncate', array($this, 'twig_filter_truncate')),
			new Twig_SimpleFilter('resample', array($this, 'twig_filter_resample')),
			new Twig_SimpleFilter('gravatar', array($this, 'twig_filter_gravatar')),
		);
	}

	/**
	 * Functions
	 */
	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('asset',  array($this, 'twig_function_asset'),  array('is_safe' => array('html'))),
			new Twig_SimpleFunction('style',  array($this, 'twig_function_style'),  array('is_safe' => array('html'))),
			new Twig_SimpleFunction('image',  array($this, 'twig_function_image'),  array('is_safe' => array('html'))),
			new Twig_SimpleFunction('script', array($this, 'twig_function_script'), array('is_safe' => array('html'))),
		);
	}

	/**
	 * Tests
	 */
	public function getTests()
	{
		return array(
			new Twig_SimpleTest('messagebag', array($this, 'twig_test_messagebag')),
		);
	}


	/*
	|--------------------------------------------------------------------------
	| FILTERS
	|--------------------------------------------------------------------------
	*/
	public function twig_filter_dump($var)
	{
		ob_start();
		var_dump($var);
		$dump = ob_get_clean();

		return "<pre>{$dump}</pre>";
	}

	public function twig_filter_words($value, $words = 100, $end = '...')
	{
		return Str::words($value, $words, $end);
	}

	public function twig_filter_truncate($value, $limit = 100, $end = '...')
	{
		return Str::limit($value, $limit, $end);
	}

	public function twig_filter_resample($url, array $params = array())
	{
		foreach ($params as $name => $value)
		{
			$params[$name] = is_array($value) ? implode(',', $value) : $value;
		}

		return urldecode(URL::route('resampler', array('url' => $url) + $params));
	}

	/**
	 * Gravatar URL from Email address
	 *
	 * @param string $email   Email address
	 * @param string $size    Size in pixels
	 * @param string $default Default image [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $rating  Max rating [ g | pg | r | x ]
	 *
	 * @return string
	 */
	public function twig_filter_gravatar($email, $size = 60, $default = 'mm', $rating = 'g')
	{
		return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . "?s={$size}&d={$default}&r={$rating}";
	}

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
	public function twig_function_asset($url)
	{
		return $this->theme->assets()->url($url);
	}

	public function twig_function_style($url, $attributes = array())
	{
		return $this->theme->assets()->style($url, $attributes);
	}

	public function twig_function_script($url, $attributes = array())
	{
		return $this->theme->assets()->script($url, $attributes);
	}

	public function twig_function_image($url, $alt = null, $attributes = array())
	{
		return $this->theme->assets()->image($url, $alt, $attributes);
	}


	/*
	|--------------------------------------------------------------------------
	| TESTS
	|--------------------------------------------------------------------------
	*/
	public function twig_test_messagebag()
	{

	}

}