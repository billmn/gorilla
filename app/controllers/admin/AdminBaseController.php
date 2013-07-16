<?php

use Carbon\Carbon;
use Gorilla\Settings;

class AdminBaseController extends Controller {

	protected $now;
	protected $logged;
	protected $locale;

	public function __construct()
	{
		$timezone     = Settings::give('timezone', 'UTC');
		$this->now    = Carbon::now($timezone);
		$this->logged = Auth::user();
		$this->locale = app('gorilla.setup')->getBrowserLang();

		Config::set('timezone', $timezone);
		Config::set('app.locale', $this->locale);

		View::share('logged', $this->logged);
	}

}