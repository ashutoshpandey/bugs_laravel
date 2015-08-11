<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('user_type', 255);
            $table->string('profile_image_name', 255);
            $table->string('profile_image_saved_name', 255);
            $table->string('status', 50);

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
