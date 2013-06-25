<?php

class AdminPostController extends AdminBaseController {

	public function index()
	{
		return View::make('admin.posts.index');
	}

	public function create()
	{
		return View::make('admin.posts.form');
	}

	public function update($id)
	{
		return View::make('admin.posts.form');
	}

	public function delete($id)
	{

	}

}