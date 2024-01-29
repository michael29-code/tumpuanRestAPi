<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $user = User::where('username', 'test')->first();
        Role::create([
            'nama_role' => 'User',
            'deskripsi' => 'role user',
            // 'user_id' => $user->id
        ]);
    }
}
