<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Observers\ModelObserver;

class Tipoproducto extends Model {

	protected $fillable = ['tipo'];

	public function productos(){

		return $this->hasMany('App\Producto', 'tipoproducto_id', 'id');

	}

	/*llamada del observer para manejar la auditoria del modelo */
  	public static function boot(){

  		parent::boot();

  		Tipoproducto::observe(new ModelObserver);
  		
  	}


	public $timestamps = false;

	protected $table = 'tipoproductos';

}
