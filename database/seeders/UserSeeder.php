<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'abc@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Abc@123'), // password
            'remember_token' => Str::random(10),
        ]);
        
    }
}
