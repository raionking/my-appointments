<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use App\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function appointments()
    {
    	// created_at -> dateTime    	
    	$monthlyCounts = Appointment::select(
			DB::raw('MONTH(created_at) as month'),
			DB::raw('COUNT(1) as count')
		)->groupBy('month')
		->get()->toArray();
		// [['month' => 11, 'count' => 6]]
		// [0,0,0,0,0, ..., 6, 0]

		$counts = array_fill(0, 12, 0); // index, qty, value

		//dd($monthlyCounts);

		foreach ($monthlyCounts as $monthlyCount) {
			$index = $monthlyCount['month']-1;
			$counts[$index] = $monthlyCount['count'];
		}
		
    	return view('charts.appointments', compact('counts'));
    }

    public function doctors()
    {
    	return view('charts.doctors');
    }

    public function doctorsJson()
    {
    	$doctors = User::doctors()
    		->select('id','name')
    		->withCount('asDoctorAppointments')
    		->orderBy('as_doctor_appointments_count','desc')
    		->take(3)
    		->get()
    		->toArray();
    	dd($doctors);
    	

    	$data = [];
    	$data['categories'] = User::doctors()->pluck('name');

    	$series = [];
    	$series1 = 1; // Atendidas
    	$series2 = 2; // Canceladas
    	$series[] = $series1;
    	$series[] = $series2;

    	$data['series'] = $series;

    	return $data;
    }
}
