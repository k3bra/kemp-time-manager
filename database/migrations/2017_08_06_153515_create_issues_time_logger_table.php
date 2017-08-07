<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIssuesTimeLoggerTable extends Migration {

	public function up()
	{
		Schema::create('issues_time_logger', function(Blueprint $table) {
			$table->integer('issue_id')->unsigned();
			$table->date('date');
			$table->integer('user_id')->unsigned();
			$table->integer('hours')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('issues_time_logger');
	}
}