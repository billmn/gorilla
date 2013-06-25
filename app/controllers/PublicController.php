<?php

use Gorilla\Post;
use Gorilla\Settings;

class PublicController extends Controller {

	public function home()
	{
		return View::make('home');
	}

	public function post($slug)
	{
		$post = Post::where('slug', $slug)->first();

		if ($post)
		{
			return View::make('post')->with('post', $post);
		}
		else
		{
			return View::make('notfound');
		}
	}

}