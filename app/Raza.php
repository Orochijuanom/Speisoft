<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model {

	protected $fillable = ['raza', 'especie_id'];

	public function especies()
	{
		return $this->belongsto('App\Especie', 'especie_id', 'id');
	}

	public $timestamps = false;

	protected $table = 'razas';

}
