<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('projects', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('description', 1000);
            $table->integer('created_by')->unsigned();
            $table->string('status', 50);

            $table->foreign('created_by')->references('id')->on('users');

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
