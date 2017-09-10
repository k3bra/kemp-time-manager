<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('users_notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->tinyInteger('type')->unsigned();
			$table->tinyInteger('seen')->unsigned()->default(0);
			$table->text('description');
		});
	}

	public function down()
	{
		Schema::drop('users_notifications');
	}
}