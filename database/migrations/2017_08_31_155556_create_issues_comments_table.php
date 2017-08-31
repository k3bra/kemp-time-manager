<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIssuesCommentsTable extends Migration {

	public function up()
	{
		Schema::create('issues_comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('body');
			$table->integer('user_id')->unsigned();
			$table->integer('issue_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('issues_comments');
	}
}