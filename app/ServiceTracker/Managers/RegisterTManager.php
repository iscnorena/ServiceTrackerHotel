<?php namespace ServiceTracker\Managers;

class RegisterTManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'name_guest'    =>'',
            'room'          =>'required',
            'request'       =>'required',
            'notes'         =>'',
            'report_by'     =>'required',
            'attend_by'     =>'required',
            'status'        =>'required',
            'add_by'        =>'required',
            'category_id'   =>'required',
            'floor'         =>'',
            'user_id'       =>'required'
            
        ];

        return $rules;
    }


} 