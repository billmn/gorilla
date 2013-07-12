<?php

use Carbon\Carbon;
use Gorilla\Settings;

class AdminBaseController extends Controller {

	protected $now;

	public function __construct()
	{
		$timezone = Settings::give('timezone', 'UTC');

		Config::set('timezone', $timezone);
		$this->now = Carbon::now($timezone);

		View::share('logged', Auth::user());
	}

}