<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// blog table
		Schema::create('news', function(Blueprint $table)
		{
			$table->increments('id');
			$table -> integer('author_id') -> unsigned() -> default(0);
			$table->foreign('author_id')
					->references('id')->on('users')
					->onDelete('cascade');
			$table->string('title')->unique();
			$table->text('body');
			$table->string('photo_image');
			$table->string('slug')->unique();
			$table->boolean('active');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// drop blog table
		Schema::drop('news');
	}

}
