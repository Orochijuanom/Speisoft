<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedores', function(Blueprint $table){

			$table->increments('id');
			$table->string('nombre', 100);
			$table->string('nit',25);
			$table->string('telefono', 15)->nullable();
			$table->string('celular',20);
			$table->string('email');

			$table->unique('nit');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proveedores');
	}

}
