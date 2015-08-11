<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('bugs', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('title', 255);
            $table->string('description', 1000);
            $table->string('severity', 255);
            $table->integer('created_by')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->string('status', 50);

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');

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
