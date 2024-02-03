<?php

namespace Tests\Feature;

use App\Models\Option;
use App\Models\Question;
use Database\Seeders\OptionSeeder;
use Database\Seeders\QuestionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OptionTest extends TestCase
{

    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();

        $this->post(
            '/api/questions/' . $question->id . '/options',
            [
                'option_text' => 'test'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'option_text' => 'test',
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class]);
        $question = Question::query()->limit(1)->first();

        $this->post(
            '/api/questions/' . $question->id . '/options',
            [
                'option_text' => ''
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'option_text' => [
                        'The option text field is required.'
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->get('/api/questions/' . $option->question_id . '/options/' . $option->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    "option_text" => "test"
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->get('/api/questions/' . $option->question_id . '/options/' . ($option->id + 1), [
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
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->put('/api/questions/' . $option->question_id . '/options/' . $option->id, [
            'option_text' => 'update'
        ], [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    "option_text" => "update"
                ]
            ]);
    }

    public function testUpdateFailed()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->put('/api/questions/' . $option->question_id . '/options/' . $option->id, [
            'option_text' => ''
        ], [
            'Authorization' => 'test'
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    "option_text" => [
                        "The option text field is required."
                    ]
                ]
            ]);
    }

    public function testUpdateNotFound()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->put('/api/questions/' . $option->question_id . '/options/' . ($option->id + 1), [
            'option_text' => 'update'
        ], [
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

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->delete(
            '/api/questions/' . $option->question_id . '/options/' . $option->id,
            [
            ],
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
        $this->seed([UserSeeder::class, QuestionSeeder::class, OptionSeeder::class]);
        $option = Option::query()->limit(1)->first();

        $this->delete(
            '/api/questions/' . $option->question_id . '/options/' . ($option->id + 1),
            [
            ],
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
