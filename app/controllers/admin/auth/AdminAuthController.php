<?php

use Gorilla\User;
use Carbon\Carbon;

class AdminAuthController extends Controller {

	public function login()
	{
		if ($_POST)
		{
			if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'), 'enabled'=> true), Input::has('remember')))
			{
				$user = Auth::user();
				$user->last_login = Carbon::now();
				$user->save();

				return Redirect::intended(URL::route('admin_home'));
			}
			else
			{
				Session::flash('errors', Lang::get('gorilla.auth.login.msg.failed'));
				return Redirect::back()->withInput();
			}
		}

		return View::make('admin.auth.login');
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('login');
	}

	public function forgot()
	{
		return View::make('admin.auth.forgot');
	}

	public function reset()
	{
		return View::make('admin.auth.reset');
	}

}