<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model {

	
    /*Bloque de relaciones*/
    public function users(){

    	return $this->belongsto('App\User', 'user_id', 'id');

    }

    public $fillable = ['action', 'model', 'user_id', 'fecha', 'ip'];

	public $timestamps = false;

	protected $table = 'audits';

}
