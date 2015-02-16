<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

	protected $fillable = ['nombre', 'apellidos', 'cedula', 'telefono', 'celular', 'email', 'direccion', 'bbm', 'facebook', 'profesion', 'cumpleanios'];

	public function mascotas()
    {
        return $this->hasMany('App\Mascota', 'cliente_id', 'id');
    }

	public $timestamps = false;

	protected $table = 'clientes';

}
