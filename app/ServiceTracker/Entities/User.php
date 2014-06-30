<?php namespace ServiceTracker\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

		/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $hidden = array('password', 'remember_token');

	protected $fillable = array('full_name', 'username', 'email', 'password');

	public function ticket()
	{
		return $this->hasMany('ServiceTracker\Entities\Ticket', 'id', 'id_user');
		//return $this->hasMany('Tema', 'asignatura_id');
        // Para declarar una relación uno a muchos se hace uso de la función hasMany().
        // Al igual que hasOne, esta función recibe dos parámetros.
        // El primero es el modelo al cual se desea asociar
        // El segundo es el id con el que se van a relacionar los modelos.
	}

	
	public function setPasswordAttribute($value)
    {
    	if ( ! empty ($value))
    	{
    		$this->attributes['password'] = \Hash::make($value);	
    	}
        
    }
	
}
