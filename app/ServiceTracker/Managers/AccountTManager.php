<?php namespace ServiceTracker\Managers;


class AccountTManager extends BaseManager {

    public function getRules()
    {
        $rules = [

            'name_guest'    =>'required',
            'room'          =>'required|integer',
            'request'       =>'required',
            'notes'         =>'required',
            'report_by'     =>'required',
            'attend_by'     =>'required',
            'status'        =>'required',
            'add_by'        =>'required',
            'attend_by'     =>'required',
            'category_id'   =>'required',
            'user_id'       =>'required'
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        $data['full_name'] = strip_tags($data['full_name']);

        return $data;
    }


} 

