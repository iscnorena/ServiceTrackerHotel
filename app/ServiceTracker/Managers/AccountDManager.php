<?php namespace ServiceTracker\Managers;


class AccountDManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'full_name'     =>'required',
            'area'          =>'',
            'ext'           =>'required',
            'direct'        =>'',
            'depto'         =>'required',
            'updated_at'    =>'required'
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        $data['full_name'] = strip_tags($data['full_name']);

        return $data;
    }


} 

