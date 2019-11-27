<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirebaseController extends Controller
{
    public function sendAll(Request $request)
    {
    	//dd($request->all());
    	$recipients = User::whereNotNull('device_token')->pluck('device_token')->toArray();

    	//dd($recipients);

    	fcm()
		    ->to($recipients) // $recipients must an array
		    ->priority('high')
		    ->timeToLive(0)
		    ->data([
		        'title' => $request->input('title'),
		        'body' => $request->input('body'),
		    ])
		    ->send();

		$notification = 'Notificación enviada a todos los usuarios (Android)';

		return back()->with(compact('notification'));
    }
}
