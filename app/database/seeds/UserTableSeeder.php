<?php

use Gorilla\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create(array(
			'username' => 'admin',
			'password' => 'admin',
			'email'    => 'admin@gorilla.dev',
			'enabled'  => true,
		));
	}

}