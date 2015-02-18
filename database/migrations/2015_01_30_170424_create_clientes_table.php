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
			$table->string('apellidos')->nullable();
			$table->string('cedula', 20)->unique();
			$table->string('telefono', 15)->nullable();
			$table->string('celular', 20);
			$table->string('email')->nullable();
			$table->string('direccion')->nullable();
			$table->string('bbm', 10)->nullable();
			$table->string('facebook')->nullable();
			$table->string('profesion')->nullable();
			$table->date('cumpleanios')->nullable();

			


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
