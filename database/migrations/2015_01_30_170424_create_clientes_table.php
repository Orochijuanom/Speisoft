<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clientes', function(Blueprint $table){

			$table->increments('id');
			$table->string('nombre');
			$table->string('apellidos');
			$table->string('cedula', 20)->unique();
			$table->string('telefono', 15);
			$table->string('celular', 20);
			$table->string('email');
			$table->string('direccion');
			$table->string('bbm', 10);
			$table->string('facebook');
			$table->string('profesion');
			$table->date('cumpleanios');

			


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clientes');
	}

}
