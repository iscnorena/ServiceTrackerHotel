<?php namespace ServiceTracker\Managers;


class AccountManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'full_name' =>'required',
            'username'  =>'required|unique:users,username,' . $this->entity->id,
            'email'     => 'required|email',
            'password'  => 'confirmed',
            'password_confirmation' => ''
        ];

        return $rules;
    }

    public function prepareData($data)
    {
        $data['full_name'] = strip_tags($data['full_name']);

        return $data;
    }


} 

