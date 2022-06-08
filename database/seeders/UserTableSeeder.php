<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
        	'email' => 'admin@admin.com', 
            'username' => 'admin',
        	'password' => Hash::make('admin'), 
        	'first_name' => 'Admin', 
        	'last_name' => 'Admin', 
        	'address' => '123 fake address', 
        	'post_code' => '1234', 
        	'contact_number' => '09001234567', 
    	]);
    }
}
