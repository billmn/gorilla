<?php namespace Gorilla;

use Gorilla\Support\Asset;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class Theme {

	protected $app;
	protected $name;
	protected $path;
	protected $info;
	protected $routes;

	public function __construct($app)
	{
		$this->app = $app;
	}

	public function set($name)
	{
		$this->name = $name;
		$this->path = $this->app['gorilla.paths.themes'] . "/{$name}";

		View::getFinder()->addLocation("{$this->path}/views");

		return $this;
	}

	public function all()
	{
		$themes = array();
		foreach (File::directories($this->app['gorilla.paths.themes']) as $path)
		{
			$name = basename($path);
			$themes[$name] = $path;
		}

		return $themes;
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