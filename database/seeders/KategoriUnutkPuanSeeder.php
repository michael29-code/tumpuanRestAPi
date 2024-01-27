<?php

namespace Database\Seeders;

use App\Models\KategoriUnutkPuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriUnutkPuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriUnutkPuan::create([
            'nama_kategori' => 'teknologi'
        ]);
    }
}
