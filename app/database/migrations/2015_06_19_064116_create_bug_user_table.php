<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('bug_users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('bug_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('status', 50);

            $table->foreign('bug_id')->references('id')->on('bugs');
            $table->foreign('user_id')->references('id')->on('users');

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
