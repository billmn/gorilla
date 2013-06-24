<?php

class AdminAuthController extends Controller {

	public function login()
	{
		if ($_POST)
		{
			if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
			{
				return Redirect::intended('dashboard');
			}
			else
			{
				Session::flash('errors', 'Login fallito');
				return Redirect::back()->withInput();
			}
		}

		return View::make('admin.auth.login');
	}

	public function logout()
	{
		
	}

	public function forgot()
	{
		
	}

	public function reset()
	{
		
	}

}