<?php

namespace App\Http\Controllers\Api;

use Auth;
use JwtAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function show()
    {
    	return Auth::guard('api')->user();
    }

    public function update(Request $request)
    {
        $user = Auth::guard('api')->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        JwtAuth::clearCache($user);
    }

    public function logout()
    {
    	Auth::guard('api')->logout();
    	$success = true;
    	return compact('success');
    }
}
