<?php

namespace Database\Seeders;

use App\Models\KontakAman;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontakAmanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'test')->first();
        KontakAman::create([
            'name' => 'Dokyeom',
            'phoneNumber' => '081234567890',
            'relation' => 'Pacar',
            'user_id' => $user->id
        ]);
    }
}
