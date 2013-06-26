<?php

use Gorilla\Post;

class ApiPostController extends ApiBaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Post::orderBy('publish_date', 'desc')->get();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make(Input::get(), array(
			'title' => 'required'
		));

		if ($validator->passes())
		{
			$post = new Post;
			$post->title        = Input::get('title');
			$post->content      = Input::get('content');
			$post->publish_date = Input::get('publish_date');
			$post->save();

			return $post;
		}
		else
		{
			return Response::json($validator->messages(), 400);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if ($post = Post::find($id))
		{
			return $post;
		}
		else
		{
			return Response::json(array('message' => 'Post not found'), 404);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if ($post = Post::find($id))
		{
			$validator = Validator::make(Input::get(), array(
				'title' => 'required'
			));

			if ($validator->passes())
			{
				$post->title        = Input::get('title');
				$post->content      = Input::get('content');
				$post->publish_date = Input::get('publish_date');
				$post->save();

				return $post;
			}
			else
			{
				return Response::json($validator->messages(), 400);
			}
		}
		else
		{
			return Response::json(array('message' => 'Post not found'), 404);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if ($post = Post::find($id))
		{
			return $post->delete();
		}
		else
		{
			return Response::json(array('message' => 'Post not found'), 404);
		}
	}

}