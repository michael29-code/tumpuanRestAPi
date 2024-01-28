<?php

namespace Database\Seeders;

use App\Models\KategoriUntukPuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriUntukPuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KategoriUntukPuan::create([
            'nama_kategori' => 'Teknologi',
            'deskripsi' => 'Kategori Teknologi Untuk Puan'
        ]);
    }
}
