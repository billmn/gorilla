<?php

use Gorilla\Settings;

class AdminBaseController extends Controller {

	public function __construct()
	{
		Config::set('timezone', Settings::give('timezone', 'UTC'));

		View::share('logged', Auth::user());
	}

}