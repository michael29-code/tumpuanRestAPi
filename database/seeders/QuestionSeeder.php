<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call(UserSeeder::class);

        $user = User::where('username', 'test')->first();
        Question::create([
            "questions" => "What is the capital of Indonesia?",
            "correct_answer" => "Jakarta",
            'user_id' => $user->id
        ]);
    }
}
