<?php

use Gorilla\Tag;

class AdminTagController extends AdminBaseController {

	public function index()
	{
		$tags = Tag::select(array('*', DB::raw('COUNT(name) as occurrence')))->groupBy('name')->orderBy('name')->get();
		return View::make('admin.tags.index')->with('tags', $tags);
	}

	public function query()
	{
		$tags = Tag::select('name')->groupBy('name');

		if ($query = Input::get('q')) $tags->where('name', 'like', "{$query}%");

		$tags = $tags->orderBy('name')->get()->map(function($item)
		{
			return array('id' => $item->name, 'text' => $item->name);
		});

		return $tags->toJson();
	}

	public function delete($name)
	{
		if ($tag = Tag::whereName($name))
		{
			$tag->delete();
			Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
		}

		return Redirect::back();
	}

}