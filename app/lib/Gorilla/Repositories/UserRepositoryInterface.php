<?php namespace Gorilla\Repositories;

interface UserRepositoryInterface {

	public function all();

	public function find($id);

	public function create(array $info);

	public function update($id, array $info);

	public function delete($id);

	public function login($username, $password, $remember = false);

}