<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('projects', function(Blueprint $table) {
			$table->foreign('created_by')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('issues', function(Blueprint $table) {
			$table->foreign('project_id')->references('id')->on('projects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('issues', function(Blueprint $table) {
			$table->foreign('created_by')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('issues', function(Blueprint $table) {
			$table->foreign('assigned_to')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('issues_time_logger', function(Blueprint $table) {
			$table->foreign('issue_id')->references('id')->on('issues')
						->onDelete('no action')
						->onUpdate('no action');
		});
		Schema::table('issues_time_logger', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::table('projects', function(Blueprint $table) {
			$table->dropForeign('projects_created_by_foreign');
		});
		Schema::table('issues', function(Blueprint $table) {
			$table->dropForeign('issues_project_id_foreign');
		});
		Schema::table('issues', function(Blueprint $table) {
			$table->dropForeign('issues_created_by_foreign');
		});
		Schema::table('issues', function(Blueprint $table) {
			$table->dropForeign('issues_assigned_to_foreign');
		});
		Schema::table('issues_time_logger', function(Blueprint $table) {
			$table->dropForeign('issues_time_logger_issue_id_foreign');
		});
		Schema::table('issues_time_logger', function(Blueprint $table) {
			$table->dropForeign('issues_time_logger_user_id_foreign');
		});
	}
}