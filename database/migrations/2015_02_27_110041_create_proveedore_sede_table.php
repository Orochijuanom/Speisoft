<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoreSedeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedore_sede', function(Blueprint $table){

			$table->increments('id');
			$table->integer('proveedore_id')->unsigned();
			$table->integer('sede_id')->unsigned();

			$table->foreign('proveedore_id')
				  ->references('id')->on('proveedores')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->foreign('sede_id')
				  ->references('id')->on('sedes')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->unique(['proveedore_id', 'sede_id']); 


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proceedore_sede');
	}

}
