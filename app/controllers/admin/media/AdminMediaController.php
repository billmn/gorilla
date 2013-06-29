<?php

use Gorilla\Media;

class AdminMediaController extends AdminBaseController {

	public function index()
	{
		$files = Media::orderBy('created_at')->get();
		return View::make('admin.media.index')->with('files', $files);
	}

	public function modal()
	{
		$files = Media::orderBy('created_at')->get();
		return View::make('admin.media.modal')->with('files', $files);
	}

	public function upload()
	{
		if (Input::hasFile('file'))
		{
			Media::upload();
		}

		return View::make('admin.media.upload');
	}

	public function delete($id)
	{
		if ($file = Media::find($id))
		{
			$file->delete();
			Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
		}

		return Redirect::back();
	}

}