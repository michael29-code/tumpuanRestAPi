<?php

namespace Database\Seeders;

use App\Models\CommentPuan;
use App\Models\SuaraPuan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentPuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->limit(1)->first();
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        CommentPuan::create([
            'user_id' => $user->id,
            'suarapuan_id' => $suarapuan->id,
            'comment' => 'test',
            'dop' => 'test',
        ]);
    }
}
