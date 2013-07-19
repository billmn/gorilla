<?php namespace Gorilla\Repositories\User;

use Gorilla\User;
use Gorilla\Repositories\UserRepositoryInterface;

class DbUserRepository implements UserRepositoryInterface {

	public function all()
	{
		return User::all();
	}

	public function find($id)
	{
		return User::findOrFail($id);
	}

	public function create(array $info)
	{

	}

	public function update($id, array $info)
	{

	}

	public function delete($id)
	{
		return User::where('id', $id)->delete();
	}

	public function login($username, $password, $remember = false)
	{
		
	}

}