<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table){

			$table->increments('id');
			$table->string('rol', 50);
			$table->text('descripcion');

		});

		DB::table('roles')->insert(
			[

				['rol' => 'Administrador' , 'descripcion' => 'Permisos Totales' ],
				['rol' => 'Medico' , 'descripcion' => 'Descripción de los permisos del medico'],
				['rol' => 'Auxilar' , 'descripcion' => 'Descripción de los permisos del auxiliar']

			]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}
