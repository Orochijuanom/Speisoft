<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productos', function(Blueprint $table){

			$table->increments('id');
			$table->string('producto', 80);
			$table->integer('tipoproducto_id')->unsigned();

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
		Schema::drop('productos');
	}

}
