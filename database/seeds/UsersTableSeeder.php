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
        User::create([
        	'name' => 'Edenilson Ruiz',
	        'email' => 'ruiz.edenilson@gmail.com',
	        'password' => bcrypt('secret'), // secret	        
	        'dni' => '016697247',
	        'address' => '',
	        'phone' => '',
	        'role' => 'admin'
        ]);
        User::create([
            'name' => 'Paciente 1',
            'email' => 'patient@datasphere.tech',
            'password' => bcrypt('secret'), // secret           
            'dni' => '',
            'address' => '',
            'phone' => '',
            'role' => 'patient'
        ]);
        User::create([
            'name' => 'Doctor 1',
            'email' => 'doctor@datasphere.tech',
            'password' => bcrypt('secret'), // secret           
            'dni' => '',
            'address' => '',
            'phone' => '',
            'role' => 'doctor'
        ]);
        factory(User::class, 50)->create();
    }
}
