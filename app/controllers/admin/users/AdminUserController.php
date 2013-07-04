<?php

use Gorilla\User;
use Gorilla\UserChangeNotAllowed;

class AdminUserController extends AdminBaseController {

	public function index()
	{
		$users = User::orderBy('username')->get();
		return View::make('admin.users.index')->with('users', $users);
	}

	public function create()
	{
		$user = new User;

		if ($_POST)
		{
			$validator = Validator::make(Input::get(), array(
				'email'    => "required|email|unique:{$user->getTable()}",
				'username' => "required|unique:{$user->getTable()}",
				'password' => "required|confirmed|min:5",
			));

			if ($validator->passes())
			{
				$user->email    = Input::get('email');
				$user->username = Input::get('username');
				$user->enabled  = Input::get('enabled', false);
				$user->password = Input::get('password');
				$user->save();

				Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
				return Redirect::route('admin_users');
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.users.form')->with('user', $user);
	}

	public function update($id)
	{
		$user = User::find($id);

		if ( ! $user)
		{
			return Redirect::route('admin_users');
		}

		if ($_POST)
		{
			$rules = array(
				'email'    => "required|email|unique:{$user->getTable()},email,{$user->id}",
				'username' => "required|unique:{$user->getTable()},username,{$user->id}",
			);

			if (Input::has('password'))
			{
				$rules['password'] = 'required|confirmed|min:5';
			}

			$validator = Validator::make(Input::get(), $rules);

			if ($validator->passes())
			{
				try
				{
					$user->email    = Input::get('email');
					$user->username = Input::get('username');
					$user->enabled  = Input::get('enabled', false);

					if (Input::has('password'))
					{
						$user->password = Input::get('password');
					}

					$user->save();

					Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
					return Redirect::route('admin_users');
				}
				catch (UserChangeNotAllowed $e)
				{
					return Redirect::back()->withInput()->with('errors', $e->getMessage());
				}
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return View::make('admin.users.form')->with('user', $user);
	}

	public function delete($id)
	{
		if ($user = User::find($id))
		{
			try
			{
				$user->delete();
				Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
			}
			catch (UserChangeNotAllowed $e)
			{
				return Redirect::back()->withInput()->with('errors', $e->getMessage());
			}
		}

		return Redirect::back();
	}

}