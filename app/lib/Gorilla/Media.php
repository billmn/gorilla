<?php namespace Gorilla;

use Intervention\Image\Image;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Media extends Model {

	protected $table  = 'media';
	protected $imgext = array('jpeg', 'png', 'bmp', 'gif');

	public function scopeImages($query)
	{
		return $query->whereIn('extension', $this->imgext);
	}

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS
	|--------------------------------------------------------------------------
	*/
	public function getPathAttribute()
	{
		return app('gorilla.paths.uploads') . '/' . $this->name;
	}

	public function getUrlAttribute()
	{
		return $this->buildUrl($this->name);
	}

	public function getBaseUrlAttribute()
	{
		return $this->buildUrl($this->name, false);
	}

	public function getThumbPathAttribute()
	{
		if ($this->thumb)
		{
			return app('gorilla.paths.uploads') . '/' . $this->thumb;
		}
	}

	public function getThumbUrlAttribute()
	{
		return $this->buildUrl($this->thumb);
	}

	public function getThumbBaseUrlAttribute()
	{
		return $this->buildUrl($this->thumb, false);
	}

	/*
	|--------------------------------------------------------------------------
	| EVENTS
	|--------------------------------------------------------------------------
	*/
	public static function boot()
	{
		parent::boot();

		static::deleting(function($model)
		{
			if (File::exists($model->path))
			{
				File::delete($model->path);
			}

			if ($model->thumb and File::exists($model->thumb_path))
			{
				File::delete($model->thumb_path);
			}
		});
	}

	/*
	|--------------------------------------------------------------------------
	| UPLOAD
	|--------------------------------------------------------------------------
	*/
	/**
	 * Upload files
	 *
	 * @return bool File uploaded successfully
	 */
	public static function upload()
	{
		$file = Input::file('file');
		$destination = app('gorilla.paths.uploads');

		if (empty($file)) return false;

		$file = reset($file);

		// File info
		$info = array(
			'path'      => $file->getRealPath(),
			'name'      => $file->getClientOriginalName(),
			'extension' => $file->guessExtension(),
			'mimetype'  => $file->getMimeType(),
			'thumb'     => null,
			'size'      => $file->getSize(),
		);

		// Thumbnail
		$isImage = Validator::make(array('file' => $file), array('file' => 'image'));

		if ($isImage->passes())
		{
			$info['thumb'] = 'thumb_' . $info['name'];
			$image = Image::make($info['path'])->grab(160, 160)->save($destination . '/' . $info['thumb']);
		}

		// Upload and save to DB
		if ($file->move($destination, $info['name']))
		{
			$model = static::where('name', $info['name'])->first() ?: new static;
			$model->name      = $info['name'];
			$model->extension = $info['extension'];
			$model->mimetype  = $info['mimetype'];
			$model->thumb     = $info['thumb'];
			$model->size      = $info['size'];

			return $model->save();
		}

		return false;
	}

	/*
	|--------------------------------------------------------------------------
	| UTILITY
	|--------------------------------------------------------------------------
	*/
	public static function emptyFolder()
	{
		$folder = app('gorilla.paths.uploads');

		File::cleanDirectory($folder);
		touch("{$folder}/.gitkeep");
	}

	/**
	 * Build URL from file name
	 *
	 * @param  string $file     File name
	 * @param  string $absolute URL including Domain name
	 * @return string
	 */
	public function buildUrl($file, $absolute = true)
	{
		$basePath = str_replace(app('path.public'), '', app('gorilla.paths.uploads'));
		return $absolute ? URL::to("{$basePath}/{$file}") : "{$basePath}/{$file}";
	}

	/**
	 * Check if a file is an image
	 *
	 * @return bool
	 */
	public function isImage()
	{
		return in_array($this->extension, $this->imgext);
	}

	/**
	 * Format Size Unit
	 *
	 * @param  int $bytes
	 * @return string
	 */
	public static function formatSize($bytes)
	{
		if ($bytes >= 1073741824)
		{
			$bytes = number_format($bytes / 1073741824, 2) . ' GB';
		}
		elseif ($bytes >= 1048576)
		{
			$bytes = number_format($bytes / 1048576, 2) . ' MB';
		}
		elseif ($bytes >= 1024)
		{
			$bytes = number_format($bytes / 1024, 2) . ' KB';
		}
		elseif ($bytes > 1)
		{
			$bytes = $bytes . ' bytes';
		}
		elseif ($bytes == 1)
		{
			$bytes = $bytes . ' byte';
		}
		else
		{
			$bytes = '0 bytes';
		}

		return $bytes;
	}

}