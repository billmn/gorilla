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
		DB::table(with(new User)->getTable())->delete();

		User::create(array(
			'username' => 'admin',
			'password' => 'admin',
			'email'    => 'admin@gorilla.dev',
			'enabled'  => true,
		));
	}

}