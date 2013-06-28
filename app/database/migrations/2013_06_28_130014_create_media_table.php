<?php

use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('extension', 10);
			$table->string('mimetype', 100);
			$table->string('thumb', 255)->nullable();
			$table->integer('size')->unsigned();
			$table->timestamps();
			$table->string('created_by');
			$table->string('updated_by');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('media');
	}

}