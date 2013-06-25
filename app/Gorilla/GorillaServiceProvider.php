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
		include_once __DIR__ . '/Support/helpers.php';

		$this->app['gorilla.paths.assets']   = public_path() . '/g-assets';
		$this->app['gorilla.paths.config']   = public_path() . '/g-config';
		$this->app['gorilla.paths.contents'] = public_path() . '/g-contents';
		$this->app['gorilla.paths.themes']   = public_path() . '/g-contents/themes';

		$this->app['gorilla.asset'] = $this->app->share(function($app)
		{
			return new Support\Asset($app['gorilla.paths.assets']);
		});

		$this->app['gorilla.theme'] = $this->app->share(function($app)
		{
			return Theme::make('default');
		});

		$this->registerFormMacro();
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