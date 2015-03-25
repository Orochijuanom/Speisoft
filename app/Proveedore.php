<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model {

	protected $fillable = ['nombre', 'nit', 'telefono', 'celular', 'email'];

	public function productos(){

		return $this->belongsToMany('App\Producto');

	}

	public function sedes(){

		return $this->belongsToMany('App\Sede');

	}


	public $timestamps = false;

	protected $table = 'proveedores';

}
