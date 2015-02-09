<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarcaProveedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marca_proveedor', function(Blueprint $table){

			$table->increments('id');
			$table->integer('marca_id')->unsigned();
			$table->integer('proveedor_id')->unsigned();
			
			$table->foreign('marca_id')
				  ->references('id')->on('marcas')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->foreign('proveedor_id')
				  ->references('id')->on('proveedores')
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
		Schema::drop('marca_proveedor');
	}

}
