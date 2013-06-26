<?php namespace Gorilla\Theme;

use Gorilla\Post;
use Gorilla\Settings;

class Tags {

	public function posts()
	{
		return Post::orderBy('publish_date', 'desc')->get();
	}

	public function settings($name, $default = null)
	{
		return Settings::give($name, $default);
	}

}