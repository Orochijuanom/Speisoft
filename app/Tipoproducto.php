<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoproducto extends Model {

	protected $fillable = ['tipo'];

	public function productos(){

		return $this->hasMany('App\Producto', 'producto_id', 'id');

	}

	public $timestamps = false;

	protected $table = 'tipoproductos';

}
