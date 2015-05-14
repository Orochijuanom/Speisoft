<?php namespace App;

use Illuminate\Database\Eloquent\Model;

//use App\Observers\ModelObserver;

class Proveedore extends Model {

	protected $fillable = ['nombre', 'nit', 'telefono', 'celular', 'email'];

	public function productos(){

		return $this->belongsToMany('App\Producto');

	}

	public function sedes(){

		return $this->belongsToMany('App\Sede');

	}

	/*llamada del observer para manejar la auditoria del modelo */
  	/*public static function boot(){

  		parent::boot();

  		Proveedore::observe(new ModelObserver);
  		
  	}*/


	public $timestamps = false;

	protected $table = 'proveedores';

}
