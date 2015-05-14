<?php namespace App;

use Illuminate\Database\Eloquent\Model;

//use App\Observers\ModelObserver;

class Raza extends Model {

	protected $fillable = ['raza', 'especie_id'];

	public function especies()
	{
		return $this->belongsto('App\Especie', 'especie_id', 'id');
	}

	/*llamada del observer para manejar la auditoria del modelo */
  	/*public static function boot(){

  		parent::boot();

  		Raza::observe(new ModelObserver);
  		
  	}*/

	public $timestamps = false;

	protected $table = 'razas';

}
