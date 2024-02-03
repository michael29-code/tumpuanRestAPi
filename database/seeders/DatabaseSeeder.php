<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(KategoriUntukPuanSeeder::class);
        $this->call(KategoriSuaraPuanSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SuaraPuanSeeder::class);
        $this->call(CommentPuanSeeder::class);
        $this->call(KontakAmanSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(OptionSeeder::class);
    }
}
