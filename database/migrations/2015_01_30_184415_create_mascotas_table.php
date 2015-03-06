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
			$table->float('peso')->nullable();
			$table->float('alzada')->nullable();
			$table->string('color', 50)->nullable();
			$table->string('pelaje',50)->nullable();
			$table->string('cicatrices', 50)->nullable();
			$table->string('cxesteticas')->nullable();
			$table->string('tatuajes', 100)->nullable();
			$table->string('condcorporal', 1)->nullable();
			$table->string('finzootecnico')->nullable();
			$table->string('entorno', 100)->nullable();
			$table->string('nutricion', 100)->nullable();
			$table->date('nacimiento')->nullable();
			$table->boolean('recordatoriocumple')->nullable();
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
