<?php namespace Gorilla\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\HTML;

class Asset {

	protected $path;

	public function __construct($path = null)
	{
		$this->path = str_replace(public_path(), '', $path);
	}

	/**
	 * Asset URL
	 *
	 * @param  string  $url
	 * @return string
	 */
	public function url($url)
	{
		return $this->buildPath($url);
	}

	/**
	 * CSS tag
	 *
	 * @param  string  $url
	 * @param  array   $attributes
	 * @return string
	 */
	public function style($url, $attributes = array())
	{
		$url = $this->buildPath($url);
		return HTML::style($url, $attributes);
	}

	/**
	 * Javascript tag
	 *
	 * @param  string  $url
	 * @param  array   $attributes
	 * @return string
	 */
	public function script($url, $attributes = array())
	{
		$url = $this->buildPath($url);
		return HTML::script($url, $attributes);
	}

	/**
	 * Image tag
	 *
	 * @param  string  $url
	 * @param  string  $alt
	 * @param  array   $attributes
	 * @return string
	 */
	public function image($url, $alt = null, $attributes = array())
	{
		$url = $this->buildPath($url);
		return HTML::image($url, $alt, $attributes);
	}

	/**
	 * Build complete asset path
	 *
	 * @param  string  $path
	 * @param  bool    $timestamp
	 * @return string
	 */
	protected function buildPath($path, $timestamp = true)
	{
		if ( ! starts_with($path, array('//', 'http://', 'https://')))
		{
			$path = "{$this->path}/{$path}";

			if ($timestamp == true and is_file($path) and File::exists($path))
			{
				return '?v=' . File::lastModified($path);
			}
		}

		return $path;
	}

}