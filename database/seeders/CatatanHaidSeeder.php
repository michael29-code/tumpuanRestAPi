<?php

namespace Database\Seeders;

use App\Models\CatatanHaid;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatatanHaidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([
        //     KategoriSuaraPuanSeeder::class,
        // ]);

        $user = User::where('username', 'test')->first();
        CatatanHaid::create([
            "start_date" => "2022-02-01",
            "end_date" => "2022-02-05",
            "cycle_length" => 28,
            "period_length" => 5,
            "start_prediction_date" => "2022-02-26",
            "end_prediction_date" => "2022-03-02",
            "status" => "on going",
            "reminder_active" => true,
            'user_id' => $user->id,
        ]);
    }
}
