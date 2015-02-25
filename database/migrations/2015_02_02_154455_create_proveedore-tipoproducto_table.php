<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoreTipoproductoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proveedore_tipoproducto', function(Blueprint $table){

			$table->increments('id');
			$table->integer('proveedore_id')->unsigned();
			$table->integer('tipoproducto_id')->unsigned();

			$table->foreign('proveedore_id')
				  ->references('id')->on('proveedores')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->foreign('tipoproducto_id')
				  ->references('id')->on('tipoproductos')
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
		Schema::drop('proveedore_tipoproducto');
	}

}
