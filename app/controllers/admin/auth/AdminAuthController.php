<?php

use Carbon\Carbon;

use Gorilla\User;
use Gorilla\Settings;

class AdminAuthController extends Controller {

	public function __construct()
	{
		Config::set('app.locale', app('gorilla.setup')->getBrowserLang());
	}

	public function login()
	{
		if ($_POST)
		{
			if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'), 'enabled'=> true), Input::has('remember')))
			{
				$user = Auth::user();
				$timezone = Settings::give('timezone', 'UTC');

				$user->last_login = Carbon::now($timezone);
				$user->save();

				return Redirect::intended(URL::route('admin_home'));
			}
			else
			{
				return Redirect::back()->withInput()->with('errors', Lang::get('gorilla.auth.login.msg.failed'));
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
		$validator = Validator::make(Input::get(), array(
			'email' => 'required|email',
		));

		if ($_POST)
		{
			if ($validator->passes())
			{
				$credentials = array('email' => Input::get('email'));

				$reminder = Password::remind($credentials, function($mail)
				{
					$mail->subject(Lang::get('gorilla.auth.forgot.email.subject'));
				});

				if (Session::has('error'))
				{
					Session::flash('errors', Lang::get('gorilla.' . Session::get('reason')));
				}
				elseif (Session::has('success'))
				{
					Session::flash('success', Lang::get('gorilla.auth.forgot.msg.success'));
				}

				return $reminder;
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.auth.forgot');
	}

	public function reset($token)
	{
		$validator = Validator::make(Input::get(), array(
			'email'                 => 'required|email',
			'password'              => 'required|min:6|confirmed',
			'password_confirmation' => 'required',
		));

		if ($_POST)
		{
			$credentials = array('email' => Input::get('email'));

			if ($validator->passes())
			{
				$reset = Password::reset($credentials, function($user, $password)
				{
					$user->password = $password;
					$user->save();

					return Redirect::route('login')->with('success', Lang::get('gorilla.auth.reset.msg.success'));
				});

				if (Session::has('error'))
				{
					Session::flash('errors', Lang::get('gorilla.' . Session::get('reason')));
				}

				return $reset;
			}
			else
			{
				return Redirect::back()->withInput($credentials)->withErrors($validator);
			}
		}

		return View::make('admin.auth.reset')->with('token', $token);
	}

}