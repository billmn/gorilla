<?php

class AdminBaseController extends Controller {

	public function __construct()
	{
		View::share('logged', Auth::user());
	}

}