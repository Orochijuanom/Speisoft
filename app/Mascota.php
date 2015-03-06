<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model {

	protected $fillable = ['nombre', 'raza_id', 'sexo', 'peso', 'alzada', 'color', 'pelaje', 'cicatrices', 'cxesteticas', 'tatuajes', 'condcorporal', 'finzootecnico', 'entorno', 'nutricion', 'nacimiento', 'recordatoriocumple', 'cliente_id'];

	public function razas()
	{

		return $this->belongsto('App\Raza', 'raza_id', 'id');

	}

	public function clientes()
	{

		return $this->belongsto('App\Cliente', 'cliente_id', 'id');

	}

	public $timestamps = false;

	protected $table = 'mascotas';

}
