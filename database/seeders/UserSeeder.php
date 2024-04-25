<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'Home',
            'phone' => '088297976356',
        ])->addRole('admin');

        \App\Models\User::create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'Home',
            'phone' => '082125801389',
        ])->addRole('employee');

        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => 'Home',
            'phone' => '1234567890123',
        ])->addRole('user');
    }
}
