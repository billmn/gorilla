<?php

class AdminSettingsController extends AdminBaseController {

	public function index()
	{
		return View::make('admin.settings.index');
	}

	public function create()
	{
		return View::make('admin.settings.form');
	}

	public function update($id)
	{
		return View::make('admin.settings.form');
	}

	public function delete($id)
	{

	}

}