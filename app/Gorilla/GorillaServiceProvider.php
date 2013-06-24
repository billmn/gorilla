<?php namespace Gorilla;

use Illuminate\Support\Facades\Form;
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
		$this->registerFormMacro();
	}

	public function registerFormMacro()
	{
		Form::macro('alert', function($type = null)
		{
			if (Session::has('errors'))
			{
				$alert  = '<div data-alert class="alert-box ' . $type . '">';
				$alert .= Session::get('errors');
				$alert .= '<a href="#" class="close">&times;</a>';
				$alert .= '</div>';

				return $alert;
			}
		});
	}

}