<?php

use Gorilla\Post;
use Gorilla\Settings;

class PublicController extends Controller {

	protected $theme;

	public function __construct()
	{
		$me = $this;

		$this->theme = app('gorilla.theme')->set(Settings::give('theme', 'default'));

		Event::listen('twigbridge.twig', function($twig) use ($me)
		{
			$twig->addExtension(new Gorilla\Theme\Extensions(array(
				'theme' => $me->theme,
			)));
		});
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

	public function rss()
	{
		$posts = Post::orderBy('publish_date', 'desc')->take(50)->get();
		$view  = $this->theme->show('rss')->with('posts', $posts);

		return Response::make($view, 200, array(
			'Content-Type' => 'application/rss+xml; charset=UTF-8',
		));
	}

}