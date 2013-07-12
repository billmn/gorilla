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
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
		});

		Schema::create('tags', function($table)
		{
			$table->increments('id');
			$table->string('post_id');
			$table->string('slug');
			$table->string('name');
			$table->timestamps();
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();

			$table->unique(array('post_id', 'name'));
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