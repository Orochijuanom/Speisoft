<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoproducto extends Model {

	protected $fillable = ['tipo'];

	public function productos(){

		return $this->hasMany('App\Producto');

	}

	public $timestamps = false;

	protected $table = 'tipoproductos';

}
