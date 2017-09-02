<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIssuesFollowersTable extends Migration {

	public function up()
	{
		Schema::create('issues_followers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('issue_id')->unsigned();
			$table->integer('user_id')->unsigned();
            $table->unique(['issue_id', 'user_id']);
		});
	}

	public function down()
	{
		Schema::drop('issues_followers');
	}
}