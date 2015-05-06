<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Observers\ModelObserver;

class Especie extends Model {

	protected $fillable = ['especie'];

	public function razas()
	{
		return $this->hasMany('App\Raza','especie_id', 'id');
	}

	/*llamada del observer para manejar la auditoria del modelo */
  	public static function boot(){

  		parent::boot();

  		Especie::observe(new ModelObserver);
  		
  	} 


	public $timestamps = false;

	protected $table = 'especies';

}
