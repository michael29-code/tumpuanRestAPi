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
        $this->call([
            KategoriSuaraPuanSeeder::class,
        ]);

        $user = User::where('username', 'test')->first();
        $kategori = KategoriSuaraPuan::query()->limit(1)->first();
        SuaraPuan::create([
            'title' => 'test',
            'content' => 'test',
            'media' => 'test',
            'dop' => 'test',
            'kategori_id' => $kategori->id,
            'user_id' => $user->id,
        ]);
    }
}
