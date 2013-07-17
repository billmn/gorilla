<?php

use Gorilla\Tag;
use Gorilla\Post;
use Gorilla\User;

class AdminHomeController extends AdminBaseController {

	public function index()
	{
		$totals = array(
			'tags'  => Tag::count(),
			'posts' => Post::count(),
			'users' => User::count(),
		);

		return View::make('admin.home.index')->with('totals', $totals);
	}

}