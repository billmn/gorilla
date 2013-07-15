<?php namespace Gorilla\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;

class Setup {

	protected $config;
	protected $contents;

	public function __construct($app)
	{
		$this->config = $app['gorilla.paths.config'] . '/gorilla.php';

		if ( ! File::exists($this->config))
		{
			$this->saveConfig(array());
		}

		$this->contents = File::getRequire($this->config);
	}

	public function check()
	{
		$status = array();

		$status['php_version']  = version_compare(PHP_VERSION, '5.3.7', '>=') ?: 'La versione di PHP installata deve essere >= 5.3.7';
		$status['ext_pdo']      = extension_loaded('pdo')      ?: 'Estensione PHP "PDO" non installata ( http://php.net/manual/en/book.pdo.php )';
		$status['ext_mcrypt']   = extension_loaded('mcrypt')   ?: 'Estensione PHP "MCrypt" non installata ( http://php.net/manual/en/book.mcrypt.php )';
		$status['ext_fileinfo'] = extension_loaded('fileinfo') ?: 'Estensione PHP "Fileinfo" non installata ( http://www.php.net/manual/en/book.fileinfo.php )';
		$status['ext_gd']       = extension_loaded('gd')       ?: 'Estensione PHP "GD" non installata ( http://www.php.net/manual/en/book.image.php )';

		return $status;
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
		$export = str_replace('array (', 'array(', var_export($this->contents, true));
		$export = str_replace('  ', "\t", $export);

		$content = '<?php' . PHP_EOL . 'return ' . $export . ';';
		return is_numeric(File::put($this->config, $content));
	}

}