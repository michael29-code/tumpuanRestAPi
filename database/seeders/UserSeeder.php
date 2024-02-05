<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test'),
            'name' => 'test',
            "dob" => "2004-01-1",
            'gender' => 0,
            'role_id' => 1,
            'token' => 'test'
        ]);

        User::create([
            'username' => 'test2',
            'email' => 'test2@gmail.com',
            'password' => Hash::make('test'),
            'name' => 'test2',
            "dob" => "2004-01-1",
            'gender' => 0,
            'role_id' => 1,
            'token' => 'test2'
        ]);
    }
}
