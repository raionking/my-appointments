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
        factory(User::class, 50)->create();
    }
}
