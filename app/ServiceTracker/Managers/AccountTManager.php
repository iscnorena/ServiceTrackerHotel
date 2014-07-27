<?php namespace ServiceTracker\Managers;


class AccountTManager extends BaseManager {

    public function getRules()
    {
        $rules = [

            'name_guest'    =>'',
            'room'          =>'required|integer',
            'group'         =>'',
            'request'       =>'required',
            'notes'         =>'',
            'report_by'     =>'required',
            'attend_by'     =>'required',
            'status'        =>'required',
            'minutes'       =>'',
            'update_by'     =>'required',
            'floor'         =>'',
            'attend_by'     =>'required',
            'category_id'   =>'required',
            'user_id'       =>''
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        $data['full_name'] = strip_tags($data['full_name']);

        return $data;
    }


} 

