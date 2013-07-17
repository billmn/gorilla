<?php

use Carbon\Carbon;
use Gorilla\Settings;

class AdminBaseController extends Controller {

	protected $now;
	protected $logged;
	protected $locale;

	public function __construct()
	{
		$this->now    = Carbon::now();
		$this->logged = Auth::user();
		$this->locale = app('gorilla.setup')->getBrowserLang();

		Config::set('app.locale', $this->locale);

		View::share('now', $this->now);
		View::share('logged', $this->logged);
		View::share('locale', $this->locale);
	}

}