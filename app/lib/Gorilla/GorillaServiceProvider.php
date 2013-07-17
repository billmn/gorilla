<?php namespace Gorilla;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class GorillaServiceProvider extends ServiceProvider {

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		
	}

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		include_once app('path') . '/helpers.php';

		$this->app['gorilla.paths.assets']   = $this->app['path.public'] . '/g-assets';
		$this->app['gorilla.paths.config']   = $this->app['path.public'] . '/g-config';
		$this->app['gorilla.paths.contents'] = $this->app['path.public'] . '/g-contents';
		$this->app['gorilla.paths.themes']   = $this->app['path.public'] . '/g-contents/themes';
		$this->app['gorilla.paths.uploads']  = $this->app['path.public'] . '/g-contents/uploads';

		$this->app['gorilla.setup'] = $this->app->share(function($app)
		{
			return new Support\Setup($app);
		});

		$this->app['gorilla.asset'] = $this->app->share(function($app)
		{
			return new Support\Asset($app['gorilla.paths.assets']);
		});

		$this->app->singleton('gorilla.theme', function($app)
		{
			return new Theme($app);
		});

		$this->dbConnect();
		$this->registerFormMacro();

		if ($this->app['gorilla.setup']->getConfig('installed', false))
		{
			date_default_timezone_set(Settings::give('timezone', 'UTC'));
			$this->theme = app('gorilla.theme')->set(Settings::give('theme', 'default'));
		}
	}

	/**
	 * Connect to Database
	 *
	 * @return void
	 */
	public function dbConnect()
	{
		if ($dbconfig = $this->app['gorilla.setup']->getConfig('db'))
		{
			Config::set('database.connections.mysql', $dbconfig);
		}
	}

	/**
	 * Register Form Macros
	 *
	 * @return void
	 */
	public function registerFormMacro()
	{
		Form::macro('save', function($text = null, $attr = array())
		{
			$text = is_null($text) ? Lang::get('gorilla.actions.save') : Lang::get("{$text}");
			$attr = array('class' => 'button small') + $attr;

			return Form::submit($text, $attr);
		});

		Form::macro('wysi', function($name, $value = null, $attr = array())
		{
			$attr = array('class' => 'wysi') + $attr;
			return Form::textarea($name, $value, $attr);
		});

		Form::macro('media', function($name, $value = null, $attr = array())
		{
			$button = "<a href=\"#\" class=\"button prefix media-button\" onclick=\"open_media_modal('{$name}', 'text', 'images')\">...</a>";
			$attr   = array('class' => 'media-input') + $attr;

			return Form::text($name, $value, $attr) . $button;
		});

		Form::macro('alert', function($type = null, $flash = 'errors')
		{
			if (Session::has($flash))
			{
				$message = Session::get($flash);
				$alert   = '<div data-alert class="alert-box ' . $type . '">';

				if (is_iterable($message))
				{
					foreach ($message as $error) $alert .= "<p>{$error}</p>";
				}
				elseif ($message instanceof MessageBag)
				{
					foreach ($message->all('<p>:message</p>') as $error) $alert .= $error;
				}
				else
				{
					$alert .= $message;
				}

				$alert .= '<a href="#" class="close">&times;</a>';
				$alert .= '</div>';

				return $alert;
			}
		});
	}

}