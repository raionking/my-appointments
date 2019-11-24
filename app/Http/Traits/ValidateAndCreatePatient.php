<?php

namespace App\Http\Traits;

use App\User;
use Illuminate\Support\Facades\Validator;

trait ValidateAndCreatePatient
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     * Moved from RegisterController to here, because is a Trait
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::$rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::createPatient($data);
    }    
}
