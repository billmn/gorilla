<?php

use Carbon\Carbon;

use Gorilla\Tag;
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
		$post = Post::where('slug', $slug)->where('publish_date', '<=', Carbon::now())->first();

		if ($post)
		{
			return $this->theme->show('post')->with('post', $post);
		}
		else
		{
			return $this->theme->show('404');
		}
	}

	public function tag($slug)
	{
		$tag = Tag::whereSlug($slug)->first();
		return $this->theme->show('tags')->with('tag', $tag);
	}

	public function rss()
	{
		$posts = Post::orderBy('publish_date', 'desc')->orderBy('id', 'desc')->take(50)->get();
		$view  = $this->theme->show('rss')->with('posts', $posts);

		return Response::make($view, 200, array(
			'Content-Type' => 'application/rss+xml; charset=UTF-8',
		));
	}

}