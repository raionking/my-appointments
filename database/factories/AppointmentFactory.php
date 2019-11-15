<?php

use Faker\Generator as Faker;
use App\User;
use App\Appointment;

$factory->define(Appointment::class, function (Faker $faker) {
	$doctorId = User::doctors()->pluck('id');
	$patientId = User::patients()->pluck('id');

	$date = $faker->dateTimeBetween('-1 years','now');
	$scheduled_date = $date->format('Y-m-d');
	$scheduled_time = $date->format('H:i:s');

	$types = ['Consulta','Examen','Operación'];
	$statuses = ['Atendida','Cancelada'];

    return [
        'description' => $faker->sentence(5) ,
        'specialty_id' => $faker->numberBetween(1,3),
        'doctor_id' => $faker->randomElement($doctorId),
        'patient_id' => $faker->randomElement($patientId),
        'scheduled_date' => $scheduled_date,
        'scheduled_time' => $scheduled_time,
        'type' => $faker->randomElement($types),
        'status' => $faker->randomElement($statuses) 
    ];
});
