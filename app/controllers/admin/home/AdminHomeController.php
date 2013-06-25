<?php

class AdminHomeController extends AdminBaseController {

	public function index()
	{
		return View::make('admin.home.index');
	}

}