<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Observers\ModelObserver;

class Producto extends Model {

	protected $fillable = ['producto', 'tipoproducto_id'];

	public function tipoproductos(){

		return $this->belongsto('App\Tipoproducto', 'tipoproducto_id', 'id');

	}

	public function proveedores(){

		return $this->belongsToMany('App\Proveedore');

	}

	/*llamada del observer para manejar la auditoria del modelo */
  	public static function boot(){

  		parent::boot();

  		Producto::observe(new ModelObserver);
  		
  	} 

	public $timestamps = false;

	protected $table = 'productos';



}
