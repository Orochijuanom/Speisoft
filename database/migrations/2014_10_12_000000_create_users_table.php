<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->softDeletes();
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->integer('rol_id')->unsigned();
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('rol_id')
				  ->references('id')->on('roles')
				  ->onDelete('restrict')
				  ->onUpdate('no action');
		});

	DB::table('users')->insert([
	
		['name' => 'Juan Sebastian Cruz Perdomo' , 'email' => 'orochijuan.nom@gmail.com' , 'rol_id' => '1'],
		['name' => 'Roberto Andres Diaz Ricardo', 'email' => 'roberto@ingenieros.com', 'rol_id' => '1']

	]);	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
