<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model {

	protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'encargado', 'nit'];

	public $timestamps = false;

	protected $table = 'sedes';

}
