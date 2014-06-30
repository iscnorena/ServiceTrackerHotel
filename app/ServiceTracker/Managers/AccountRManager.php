<?php namespace ServiceTracker\Managers;


class AccountTManager extends BaseManager {

    public function getRules()
    {
        $rules = [

            'status'        =>'required',
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        $data['full_name'] = strip_tags($data['full_name']);

        return $data;
    }


} 

