<?php

use Carbon\Carbon;
use Gorilla\Post;

class AdminPostController extends AdminBaseController {

	public function index()
	{
		$posts = Post::orderBy('created_at', 'desc')->get();
		return View::make('admin.posts.index')->with('posts', $posts);
	}

	public function create()
	{
		$post = new Post;
		$post->publish_date = Carbon::now();

		if ($_POST)
		{
			$validator = Validator::make(Input::get(), array(
				'title'        => 'required',
				'slug'         => 'required',
				'publish_date' => 'required',
			));

			if ($validator->passes())
			{
				$post->title   = Input::get('title');
				$post->slug    = Input::get('slug');
				$post->content = Input::get('content');
				$post->save();

				Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
				return Redirect::route('admin_post_update', array('id' => $post->id));
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.posts.form')->with('post', $post);
	}

	public function update($id)
	{
		$post = Post::find($id);

		if ($_POST)
		{
			$validator = Validator::make(Input::get(), array(
				'title'        => 'required',
				'slug'         => 'required',
				'publish_date' => 'required',
			));

			if ($validator->passes())
			{
				$post->title   = Input::get('title');
				$post->slug    = Input::get('slug');
				$post->content = Input::get('content');
				$post->save();

				Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
				return Redirect::route('admin_post_update', array('id' => $post->id));
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.posts.form')->with('post', $post);
	}

	public function delete($id)
	{
		if ($post = Post::find($id))
		{
			$post->delete();
			Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
		}

		return Redirect::back();
	}

	public function slug()
	{
		$title  = Input::get('title');
		$postId = Input::get('post_id');

		return Post::sluggify($title, $postId);
	}

}