<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('slug')->unique();
			$table->integer('media_id')->unsigned()->nullable();
			$table->text('content');
			$table->timestamp('publish_date');
			$table->timestamps();
			$table->string('created_by');
			$table->string('updated_by');
		});

		Schema::create('tags', function($table)
		{
			$table->increments('id');
			$table->string('post_id');
			$table->string('name');
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
		Schema::dropIfExists('tags');
		Schema::dropIfExists('posts');
	}

}