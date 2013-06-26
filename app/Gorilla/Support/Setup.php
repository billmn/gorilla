<?php namespace Gorilla\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class Setup {

	protected $config;
	protected $contents;

	public function __construct($app)
	{
		$this->config = $app['path'] . '/config/gorilla.php';
		$this->contents = File::getRequire($this->config);
	}

	public function getConfig($name = null, $default = null)
	{
		if (is_null($name))
		{
			return $this->contents;
		}

		return array_get($this->contents, $name, $default);
	}

	public function setConfig($name, $value)
	{
		array_set($this->contents, $name, $value);
		return $this;
	}

	public function saveConfig()
	{
		$content = '<?php' . PHP_EOL . 'return ' . var_export($this->contents, true) . ';';
		return is_numeric(File::put($this->config, $content));
	}

}