<?php

class AdminHomeController extends Controller {

	public function index()
	{
		return View::make('admin.home.index');
	}

}