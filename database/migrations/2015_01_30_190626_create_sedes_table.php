<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sedes', function(Blueprint $table){

			$table->increments('id');
			$table->string('nombre');
			$table->string('direccion');
			$table->string('telefono', 15);
			$table->string('email', 70);
			$table->string('encargado');
			$table->string('nit', 25);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sedes');
	}

}
