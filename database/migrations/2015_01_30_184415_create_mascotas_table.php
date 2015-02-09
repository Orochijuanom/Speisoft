<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMascotasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mascotas', function(Blueprint $table){

			$table->increments('id');
			$table->string('nombre');
			$table->integer('raza_id')->unsigned();
			$table->string('sexo', 1);
			$table->float('peso');
			$table->float('alzada');
			$table->string('color', 50);
			$table->string('pelaje',50);
			$table->string('cicatrices', 50);
			$table->string('cxesteticas');
			$table->string('tatuajes', 100);
			$table->string('condcorporal', 1);
			$table->string('finzootecnico');
			$table->string('entorno', 100);
			$table->string('nutricion', 100);
			$table->string('estilovida', 50);
			$table->date('nacimiento');
			$table->boolean('recordatoriocumple');
			$table->integer('cliente_id')->unsigned();

			$table->foreign('raza_id')
				  ->references('id')->on('razas')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->foreign('cliente_id')
				  ->references('id')->on('clientes')
				  ->onDelete('restrict')
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
		Schema::drop('mascotas');
	}

}
