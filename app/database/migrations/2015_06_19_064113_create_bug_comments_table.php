<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('bug_comments', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('comment', 1000);
            $table->integer('created_by')->unsigned();
            $table->integer('bug_id')->unsigned();
            $table->string('status', 50);

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('bug_id')->references('id')->on('bugs');

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
	}

}
