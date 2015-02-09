<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRazasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('razas', function(Blueprint $table){

			$table->increments('id');
			$table->integer('especie_id')->unsigned();
			$table->string('raza', 50);

			$table->foreign('especie_id')
				  ->references('id')->on('especies')
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
		Schema::drop('razas');
	}

}
