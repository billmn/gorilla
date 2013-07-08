<?php

use Gorilla\User;

class InstallController extends Controller {

	public function __construct()
	{
		if (app('gorilla.setup')->getConfig('installed') and Request::segment(2) !== 'step3')
		{
			return App::abort(404, 'Page not found');
		}
	}

	public function getIndex()
	{
		return Redirect::to('install/check');
	}

	public function getCheck()
	{
		$requirements = app('gorilla.setup')->check();
		$valid = array_sum($requirements) === count($requirements);

		return View::make('install.index')->with('requirements', $requirements)->with('valid', $valid);
	}

	public function getStep1()
	{
		return View::make('install.step1');
	}

	public function postStep1()
	{
		$validator = Validator::make(Input::get(), array(
			'host'     => 'required',
			'name'     => 'required',
			'username' => 'required',
			'password' => 'required',
		));

		if ($validator->passes())
		{
			try
			{
				$conn = array(
					'driver'    => 'mysql',
					'host'      => Input::get('host'),
					'database'  => Input::get('name'),
					'username'  => Input::get('username'),
					'password'  => Input::get('password'),
					'charset'   => 'utf8',
					'collation' => 'utf8_unicode_ci',
					'prefix'    => '',
				);

				// Test DB connection
				app('db.factory')->make($conn);

				// Save DB connection
				app('gorilla.setup')->setConfig('db', $conn)->saveConfig();

				// Migrate database
				$artisan = Artisan::call('migrate');

				if ($artisan)
				{
					return Redirect::back()->with('errors', 'Unable to migrate database');
				}

				return Redirect::to('install/step2');
			}
			catch (Exception $e)
			{
				return Redirect::back()->withInput()->with('errors', $e->getMessage());
			}
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	public function getStep2()
	{
		return View::make('install.step2');
	}

	public function postStep2()
	{
		$validator = Validator::make(Input::get(), array(
			'email'    => 'required|email',
			'password' => 'required|min:6|confirmed',
		));

		if ($validator->passes())
		{
			$user = User::where('username', 'admin')->first() ?: new User;
			$user->username = 'admin';
			$user->email    = Input::get('email');
			$user->password = Input::get('password');
			$user->enabled  = true;
			$user->save();

			// Installed successfully
			app('gorilla.setup')->setConfig('installed', true)->saveConfig();

			return Redirect::to('install/step3');
		}
		else
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}
	}

	public function getStep3()
	{
		return View::make('install.step3');
	}

}