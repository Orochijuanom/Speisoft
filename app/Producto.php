<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model {

	protected $fillable = ['producto', 'tipoproducto_id'];

	public function tipoproductos(){

		return $this->belongsto('App\Tipoproducto', 'tipoproducto_id', 'id');

	}

	public $timestamps = false;

	protected $table = 'productos';



}
