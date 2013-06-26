<?php namespace Gorilla;

use Gorilla\Support\Asset;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class Theme {

	protected $name;
	protected $path;
	protected $info;
	protected $routes;

	public static function make($name)
	{
		return new static($name);
	}

	protected function __construct($name)
	{
		$this->name = $name;
		$this->path = app('gorilla.paths.themes') . "/{$name}";

		View::getFinder()->addLocation("{$this->path}/views");
	}

	public function path($absolute = false)
	{
		return $absolute ? $this->path : str_replace(public_path(), '', $this->path);
	}

	public function assets()
	{
		return new Asset($this->path);
	}

	public function show($name)
	{
		try
		{
			return View::make($name);
		}
		catch (\Exception $e)
		{
			if (View::exists("public_{$name}"))
			{
				return View::make("public_{$name}");
			}

			throw $e;
		}
	}

	public function info()
	{
		$file = "{$this->path}/info.php";
		return File::exists($file) ? include_once($file) : array();

		return array();
	}

	public function routes()
	{
		$file = "{$this->path}/routes.php";
		return File::exists($file) ? include_once($file) : array();
	}

}