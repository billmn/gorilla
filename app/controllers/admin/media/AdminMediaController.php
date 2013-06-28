<?php

use Gorilla\Media;

class AdminMediaController extends AdminBaseController {

	public function index()
	{
		return View::make('admin.media.index');
	}

	public function upload()
	{
		if (Input::hasFile('file'))
		{
			Media::upload();
		}

		return View::make('admin.media.upload');
	}

}
