<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBugCommentFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('bug_comment_files', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('file_name', 1000);
            $table->string('saved_file_name', 1000);
            $table->integer('bug_comment_id')->unsigned();
            $table->string('status', 50);

            $table->foreign('bug_comment_id')->references('id')->on('bug_comments');

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
