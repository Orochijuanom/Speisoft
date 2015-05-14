<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAuxSede extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aux_sede', function(Blueprint $table){

			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('sede_id')->unsigned();

			$table->foreign('user_id')
				  ->references('id')->on('users')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->foreign('sede_id')
				  ->references('id')->on('sedes')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->unique('user_id');

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
