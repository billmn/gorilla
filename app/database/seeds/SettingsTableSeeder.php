<?php

use Carbon\Carbon;
use Gorilla\Settings;

class SettingsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$now = Carbon::now();

		DB::table(with(new Settings)->getTable())->delete();

		Settings::insert(array(
			array(
				'name'       => 'website_title',
				'value'      => 'Titolo sito',
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'name'       => 'website_slogan',
				'value'      => 'Il mio nuovo microblog',
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'name'       => 'website_footer',
				'value'      => 'Footer del sito',
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'name'       => 'timezone',
				'value'      => 'UTC',
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'name'       => 'theme',
				'value'      => 'default',
				'created_at' => $now,
				'updated_at' => $now,
			),
		));
	}

}