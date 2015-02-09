<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoProveedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producto_proveedor', function(Blueprint $table){

			$table->increments('id');
			$table->integer('producto_id')->unsigned();
			$table->integer('proveedor_id')->unsigned();
			
			$table->foreign('producto_id')
				  ->references('id')->on('productos')
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
		Schema::drop('producto_proveedor');
	}

}
