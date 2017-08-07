<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIssuesTable extends Migration {

	public function up()
	{
		Schema::create('issues', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('estimated_time');
			$table->string('name', 100);
			$table->integer('project_id')->unsigned();
			$table->text('description');
			$table->smallInteger('status')->unsigned()->default('1');
			$table->integer('created_by')->unsigned();
			$table->integer('assigned_to')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('issues');
	}
}