<?php

namespace Database\Seeders;

use App\Models\KategoriSuaraPuan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSuaraPuanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('username', 'test')->first();
        KategoriSuaraPuan::create([
            'nama' => 'Valina Evelyn',
            'deskripsi' => 'Saya suka warna biru'
        ]);
    }
}
