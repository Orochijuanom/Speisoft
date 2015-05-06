<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Observers\ModelObserver;

class Cliente extends Model {

	protected $fillable = ['nombre', 'apellidos', 'cedula', 'telefono', 'celular', 'email', 'direccion', 'bbm', 'facebook', 'profesion', 'cumpleanios'];

	/*Bloque de relaciones*/
	public function mascotas()
    {
        return $this->hasMany('App\Mascota', 'cliente_id', 'id');
    }

    /*llamada del observer para manejar la auditoria del modelo */
  	public static function boot(){

  		parent::boot();

  		Cliente::observe(new ModelObserver);
  		
  	} 


	public $timestamps = false;

	protected $table = 'clientes';

}
