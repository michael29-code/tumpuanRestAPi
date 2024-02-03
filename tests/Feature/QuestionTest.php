<?php

namespace Tests\Feature;

use App\Models\Question;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->post(
            '/api/questions',
            [
                'questions' => 'Apa warna langit?',
                'correct_answer' => 'Biru'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'questions' => 'Apa warna langit?',
                    'correct_answer' => 'Biru'
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->post(
            '/api/questions',
            [
                'questions' => '',
                'correct_answer' => 'Biru'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'questions' => [
                        'The questions field is required.'
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();
        $this->get('/api/questions/' . $question->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    "questions" => "What is the capital of Indonesia?",
                    "correct_answer" => "Jakarta"
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();
        $this->get('/api/questions/' . ($question->id + 1), [
            'Authorization' => 'test'
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ]);
    }

    public function testUpdateSuccess()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();

        $this->put(
            '/api/questions/' . $question->id,
            [
                "questions" => "What is the capital of Indonesia?2",
                "correct_answer" => "Jakarta2"
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    "questions" => "What is the capital of Indonesia?2",
                    "correct_answer" => "Jakarta2"
                ]
            ]);
    }

    public function testUpdateValidationError()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();

        $this->put(
            '/api/questions/' . $question->id,
            [
                "questions" => "",
                "correct_answer" => "Jakarta2"
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'questions' => [
                        'The questions field is required.',
                    ]
                ]
            ]);
    }

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();
        $this->delete(
            '/api/questions/' . $question->id,
            [],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testDeleteNotFound()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();
        $this->delete(
            '/api/questions/' . ($question->id + 1),
            [],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ]);
    }

}
