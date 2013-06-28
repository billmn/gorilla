<?php namespace Gorilla;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Media extends Model {

	protected $table = 'media';

	public static function upload()
	{
		$file = Input::file('file');
		$destination = app('gorilla.paths.uploads');

		// File info
		$info = array(
			'name'      => $file->getClientOriginalName(),
			'extension' => $file->guessExtension(),
			'mimetype'  => $file->getMimeType(),
			'size'      => $file->getSize(),
		);

		// Thumbnail
		$isImage = Validator::make(Input::file(), array('file' => 'image'));

		if ($isImage->passes())
		{
			
		}

		if ($file->move($destination, $info['name']))
		{
			$model = static::where('name', $info['name'])->first() ?: new static;
			$model->name      = $info['name'];
			$model->extension = $info['extension'];
			$model->mimetype  = $info['mimetype'];
			$model->size      = $info['size'];

			return $model->save();
		}

		return false;
	}

}