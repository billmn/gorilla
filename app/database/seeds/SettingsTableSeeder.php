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
				'value'      => 'Website title',
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'name'       => 'website_slogan',
				'value'      => 'My new Microbolog',
				'created_at' => $now,
				'updated_at' => $now,
			),
			array(
				'name'       => 'website_footer',
				'value'      => '&copy; My Website',
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