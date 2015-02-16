<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Especie extends Model {

	protected $fillable = ['especie'];

	public function razas()
	{
		return $this->hasMany('App\raza','especie_id', 'id');
	}

	public $timestamps = false;

	protected $table = 'especies';

}
