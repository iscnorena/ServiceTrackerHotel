<?php namespace ServiceTracker\Managers;

class RegisterManager extends BaseManager {

    public function getRules()
    {
        $rules = [
            'full_name' =>'required',
            'username'  =>'required|unique:users,username',
            'email'     =>'required|email',
            'view' =>'required',
            'type' =>'required',
            'password'  =>'required|confirmed',
            'password_confirmation' => 'required'
        ];

        return $rules;
    }


} 