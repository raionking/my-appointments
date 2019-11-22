<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserController extends Controller
{
    public function show()
    {
    	return Auth::guard('api')->user();
    }

    public function logout()
    {
    	Auth::guard('api')->logout();
    	$success = true;
    	return compact('success');
    }
}
