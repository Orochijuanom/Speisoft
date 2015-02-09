<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model{

	protected $fillable = ['rol','descripcion'];
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	
}