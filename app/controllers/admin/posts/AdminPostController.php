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
				'title' => 'required',
			));

			if ($validator->passes())
			{
				$post->title        = Input::get('title');
				$post->slug         = Input::get('slug');
				$post->content      = Input::get('content');
				$post->media_id     = Input::get('media_id');
				$post->publish_date = Input::get('publish_date');
				$post->save();

				// Update Tags
				$post->syncTags(explode(',', Input::get('tags')));

				Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
				return Redirect::route('admin_post_update', array('id' => $post->id));
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.posts.form')->with('post', $post)->with('post_tags', '[]');
	}

	public function update($id)
	{
		$post = Post::find($id);

		if ( ! $post)
		{
			return Redirect::route('admin_posts');
		}

		$postTags = $post->tags()->orderBy('name')->get()->map(function($item)
		{
			return array('id' => $item->name, 'text' => $item->name);
		})->toJson();

		if ($_POST)
		{
			$validator = Validator::make(Input::get(), array(
				'title'        => 'required',
				'publish_date' => 'required',
			));

			if ($validator->passes())
			{
				$post->title        = Input::get('title');
				$post->slug         = Input::get('slug');
				$post->content      = Input::get('content');
				$post->media_id     = Input::get('media_id');
				$post->publish_date = Input::get('publish_date');
				$post->save();

				// Update Tags
				$post->syncTags(explode(',', Input::get('tags')));

				Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
				return Redirect::route('admin_post_update', array('id' => $post->id));
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.posts.form')->with('post', $post)->with('post_tags', $postTags);
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

}