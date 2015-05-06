<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('action');
			$table->string('model');
			$table->integer('user_id')->unsigned();
			$table->dateTime('fecha');
			$table->string('ip');

			$table->foreign('user_id')
				  ->references('id')->on('users')
				  ->onDelete('no action')
				  ->onUpdate('no action');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
