<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        User::create([
        	'name' => 'Edenilson Ruiz',
	        'email' => 'ruiz.edenilson@example.com',
	        'password' => bcrypt('secret'), // secret	        
	        'dni' => '016697247',
	        'address' => '',
	        'phone' => '',
	        'role' => 'admin'
        ]);

        //2
        User::create([
            'name' => 'Paciente 1',
            'email' => 'patient@example.com',
            'password' => bcrypt('secret'), // secret           
            'dni' => '',
            'address' => '',
            'phone' => '',
            'role' => 'patient'
        ]);

        //3
        User::create([
            'name' => 'Doctor 1',
            'email' => 'doctor@example.com',
            'password' => bcrypt('secret'), // secret           
            'dni' => '',
            'address' => '',
            'phone' => '',
            'role' => 'doctor'
        ]);
        factory(User::class, 50)->states('patient')->create();       
    }
}
