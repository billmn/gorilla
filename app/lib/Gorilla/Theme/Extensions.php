<?php namespace Gorilla\Theme;

use Twig_SimpleTest;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use Twig_ExpressionParser;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\Request;

use Gorilla\Support\TruncateHtmlString;

class Extensions extends \TwigBridge\Extension {

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
			new Twig_SimpleFilter('words',         array($this, 'twig_filter_words')),
			new Twig_SimpleFilter('truncate',      array($this, 'twig_filter_truncate')),
			new Twig_SimpleFilter('resample',      array($this, 'twig_filter_resample')),
			new Twig_SimpleFilter('gravatar',      array($this, 'twig_filter_gravatar')),
			new Twig_SimpleFilter('email_protect', array($this, 'twig_filter_email_protect')),
		);
	}

	/**
	 * Functions
	 */
	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('url',     array($this, 'twig_function_url'),     array('is_safe' => array('html'))),
			new Twig_SimpleFunction('asset',   array($this, 'twig_function_asset'),   array('is_safe' => array('html'))),
			new Twig_SimpleFunction('style',   array($this, 'twig_function_style'),   array('is_safe' => array('html'))),
			new Twig_SimpleFunction('image',   array($this, 'twig_function_image'),   array('is_safe' => array('html'))),
			new Twig_SimpleFunction('script',  array($this, 'twig_function_script'),  array('is_safe' => array('html'))),
			new Twig_SimpleFunction('is_home', array($this, 'twig_function_is_home'), array('is_safe' => array('html'))),
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
	public function twig_filter_words($value, $words = 100, $end = '...')
	{
		return Str::words($value, $words, $end);
	}

	public function twig_filter_truncate($value, $limit = 100, $end = ' ...')
	{
		$value = trim($value);

		if (is_html($value))
		{
			$htmlTruncator = new TruncateHtmlString($value, $limit, $end);
			return $htmlTruncator->cut();
		}

		return Str::limit($value, $limit, $end);
	}

	public function twig_filter_resample($url, array $params = array())
	{
		foreach ($params as $name => $value)
		{
			$params[$name] = is_array($value) ? implode(',', $value) : $value;
		}

		return URL::route('resampler', array('url' => $url) + $params);
	}

	public function twig_filter_gravatar($email, $size = 60, $default = 'mm', $rating = 'g')
	{
		return gravatar($email, $size, $default, $rating);
	}

	public function twig_filter_email_protect($string)
	{
		preg_match_all("/[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i", $string, $matches);

		if (count($matches))
		{
			$matches    = $matches[0];
			$obfuscated = array_map(function($email) { return HTML::email($email); }, $matches);
			$string     = str_replace($matches, $obfuscated, $string);
		}

		return $string;
	}

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
	public function twig_function_url($route, $params = array())
	{
		return URL::route($route, $params);
	}

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

	public function twig_function_is_home()
	{
		return Request::is('/');
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