<?php

use Gorilla\Post;
use Gorilla\Settings;

class PublicController extends Controller {

	protected $theme;

	public function __construct()
	{
		$this->theme = app('gorilla.theme');
	}

	public function home()
	{
		return $this->theme->show('home');
	}

	public function post($slug)
	{
		$post = Post::where('slug', $slug)->first();

		if ($post)
		{
			return $this->theme->show('post')->with('post', $post);
		}
		else
		{
			return $this->theme->show('404');
		}
	}

}