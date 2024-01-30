<?php

namespace Database\Seeders;

use App\Models\KategoriSuaraPuan;
use App\Models\SuaraPuan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuaraPuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->limit(1)->first();
        $kategori = KategoriSuaraPuan::query()->limit(1)->first();
        SuaraPuan::create([
            'user_id' => $user->id,
            'kategori_id' => $kategori->id,
            'title' => 'test',
            'content' => 'test',
            'media' => 'test',
            'dop' => 'test',
        ]);
    }
}
