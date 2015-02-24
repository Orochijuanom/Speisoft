<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('stocks', function(Blueprint $table){

			$table->increments('id');
			$table->integer('producto_id')->unsigned();
			$table->integer('sede_id')->unsigned();
			$table->integer('cantidad');
			$table->float('valor');

			$table->unique(['producto_id', 'sede_id']);

			$table->foreign('producto_id')
				  ->references('id')->on('productos')
				  ->onDelete('restrict')
				  ->onUpdate('no action');

			$table->foreign('sede_id')
				  ->references('id')->on('sede')
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
		Schema::drop('stocks');
	}

}
