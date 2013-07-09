<?php

use Gorilla\Media;
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
			$table->string('name')->unique();
			$table->string('extension', 10);
			$table->string('mimetype', 100);
			$table->string('thumb', 255)->nullable();
			$table->integer('size')->unsigned();
			$table->timestamps();
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
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
		Media::emptyFolder();
	}

}