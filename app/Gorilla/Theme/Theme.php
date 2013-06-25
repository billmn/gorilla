<?php namespace Gorilla;

use Illuminate\Support\Facades\View;

class Theme {

	protected $name;
	protected $path;

	public static function make($name)
	{
		return new static($name);
	}

	protected function __construct($name)
	{
		$this->name = $name;
		$this->path = app('gorilla.paths.themes') . "/{$name}";

		View::getFinder()->addLocation($this->path);
	}

	public function show($name)
	{
		try
		{
			$view = View::make($name);
		}
		catch (\Exception $e)
		{
			$view = View::make("public_{$name}");
		}

		return $view;
	}

}