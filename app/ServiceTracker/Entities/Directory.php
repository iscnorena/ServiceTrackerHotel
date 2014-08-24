<?php namespace ServiceTracker\Entities;




class Directory extends \Eloquent {

    //protected $fillable = array('name_guest', 'room', 'group', 'request','notes','report_by','attend_by','status', 'minutes', 'removed', 'floor', 'update_by', 'delete_by', 'resolved_at', 'add_by','category_id','user_id');
    protected $perPage = 10;
    protected $table = 'directory';

    /*
    public function user()
    {

       return $this->hasOne('ServiceTracker\Entities\User', 'id', 'id');
         //return $this->hasOne('Pasaporte', 'persona_id');
        // Para declarar una relación uno a uno se utiliza la función hasOne().
        // Esta función recibe como primer parámetro el modelo que queremos hacer la relación 
        // en este caso es Pasaporte.
        // El segundo parámetro es el campo id con el cual se relación el modelo. 
        // En este caso Eloquent busca el pasaporte que tenga persona_id igual al 
        // id de la Persona
    }*/

    /*
    public function category()
    {
    	return $this->belongsTo('ServiceTracker\Entities\Category');
        //return $this->belongsTo('Asignatura', 'asignatura_id');
        // La relación Pertenece a se declara con la función belongsTo
        // esta acepta dos parámetros
        // El primero es la tabla a donde pertecene la relación
        // El segundo es el id de la tabla padre en la tabla actual
        // En este caso seria el id de Asignatura en tema 
    }
    */

    /*
    public function getJobTypeTitleAttribute()
    {
        return \Lang::get('utils.job_types.' . $this->job_type);
    }
    */
}