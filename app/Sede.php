<?php namespace App;

use Illuminate\Database\Eloquent\Model;

//use App\Observers\ModelObserver;

class Sede extends Model {

	protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'encargado', 'nit'];

	/*llamada del observer para manejar la auditoria del modelo */
  	/*public static function boot(){

  		parent::boot();

  		Sede::observe(new ModelObserver);
  		
  	}*/

	public $timestamps = false;

	protected $table = 'sedes';

}
