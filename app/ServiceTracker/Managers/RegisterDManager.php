<?php namespace ServiceTracker\Managers;

class RegisterDManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'full_name'     =>'required',
            'area'          =>'',
            'ext'           =>'required',
            'direct'        =>'',
            'depto'         =>'required',
            'updated_at'        =>'',
            'created_at'        =>''
        ];

        return $rules;
    }


} 