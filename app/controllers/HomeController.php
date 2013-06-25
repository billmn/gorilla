<?php

class HomeController extends Controller {

	public function showWelcome()
	{
		return View::make('hello');
	}

}