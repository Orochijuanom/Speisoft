<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

//use App\Observers\ModelObserver;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'users';

    protected $dates = ['deleted_at'];

   	/*Bloque se relaciones*/
    public function roles(){

		return $this->belongsTo('App\Rol', 'rol_id');

	}

	public function autions(){

		return $this->hasMany('App\Audit', 'user_id', 'id');
	}

	/*funcion para tomar la imagen de gravatar
	requiere que el email del usuario este relacionada
	a una cuenta de gravatar
	*/
	public function getGravatarAttribute(){

  		$hash = md5(strtolower(trim($this->attributes['email'])));
  		return "http://www.gravatar.com/avatar/$hash";
  	}

  	/*llamada del observer para manejar la auditoria del modelo */
  	/*public static function boot(){

  		parent::boot();

  		User::observe(new ModelObserver);
  		
  	} */

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','rol_id'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


}
