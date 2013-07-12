<?php namespace Gorilla\Theme;

use Gorilla\Post;
use Gorilla\Settings;

class Tags {

	public function posts($params = array())
	{
		$posts = Post::orderBy('publish_date', 'desc');
		return isset($params['paginate']) ? $posts->paginate($params['paginate']) : $posts->get();
	}

	public function settings($name, $default = null)
	{
		return Settings::give($name, $default);
	}

}