<?php

namespace App\Http\Controllers\Api;

use Auth;
use JwtAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Traits\ValidateAndCreatePatient;


class AuthController extends Controller
{
    use ValidateAndCreatePatient;

    public function login(Request $request)
    {
    	$credential = $request->only('email','password');
    	
    	if(Auth::guard('api')->attempt($credential)) {
		    $user = Auth::guard('api')->user();		    
		    $jwt = JwtAuth::generateToken($user);
		    $success = true;

		    
		    // Return successfull sign in response with the generated jwt.
		    return compact('success','user','jwt');

		} else {
			// Return response for failed attempt.
		    $success = false;
		    $message = 'Invalid credentials';
		    return compact('success','message');
		}
    }

    public function register(Request $request)
    {
    	$this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        Auth::guard('api')->login($user);

        $jwt = JwtAuth::generateToken($user);
		$success = true;

		// Return successfull sign in response with the generated jwt.
		return compact('success','user','jwt');
    }    
}
