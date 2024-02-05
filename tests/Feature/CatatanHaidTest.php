<?php

namespace Tests\Feature;

use App\Models\CatatanHaid;
use App\Models\User;
use Database\Seeders\CatatanHaidSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CatatanHaidTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->post(
            '/api/catatanhaids',
            [
                'start_date' => '2021-01-01',
                'end_date' => '2021-01-05',
                'cycle_length' => 28,
                'period_length' => 5,
                'start_prediction_date' => '2021-01-29',
                'end_prediction_date' => '2021-02-02',
                'status' => 'on progress',
                'reminder_active' => true,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'start_date' => '2021-01-01',
                    'end_date' => '2021-01-05',
                    'cycle_length' => 28,
                    'period_length' => 5,
                    'start_prediction_date' => '2021-01-29',
                    'end_prediction_date' => '2021-02-02',
                    'status' => 'on progress',
                    'reminder_active' => true,
                ]
            ]);
    }

    public function testCreatedFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->post(
            '/api/catatanhaids',
            [
                'start_date' => '',
                'end_date' => '2021-01-05',
                'cycle_length' => 28,
                'period_length' => 5,
                'start_prediction_date' => '2021-01-29',
                'end_prediction_date' => '2021-02-02',
                'status' => 'on progress',
                'reminder_active' => true,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'start_date' => [
                        'The start date field is required.'
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, CatatanHaidSeeder::class]);
        $user = User::query()->limit(1)->first();

        $this->get('/api/catatanhaids/' . $user->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    "start_date" => "2022-02-01",
                    "end_date" => "2022-02-05",
                    "cycle_length" => 28,
                    "period_length" => 5,
                    "start_prediction_date" => "2022-02-26",
                    "end_prediction_date" => "2022-03-02",
                    "status" => "on going",
                    "reminder_active" => true
                ]
            ]);
    }

    public function testGetOtherUserCatatanHaid()
    {
        $this->seed([UserSeeder::class, CatatanHaidSeeder::class]);
        $user = User::query()->limit(1)->first();

        $this->get('/api/catatanhaids/' . $user->id, [
            'Authorization' => 'test2'
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
        $this->seed([UserSeeder::class, CatatanHaidSeeder::class]);
        $user = User::query()->limit(1)->first();

        $this->put(
            '/api/catatanhaids/' . $user->id,
            [
                'start_date' => '2022-03-01',
                'end_date' => '2022-03-05',
                'cycle_length' => 29,
                'period_length' => 6,
                'start_prediction_date' => '2022-03-27',
                'end_prediction_date' => '2022-04-02',
                'status' => 'finished',
                'reminder_active' => false,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'start_date' => '2022-03-01',
                    'end_date' => '2022-03-05',
                    'cycle_length' => 29,
                    'period_length' => 6,
                    'start_prediction_date' => '2022-03-27',
                    'end_prediction_date' => '2022-04-02',
                    'status' => 'finished',
                    'reminder_active' => false,
                ]
            ]);
    }

    public function testUpdateValidationError()
    {
        $this->seed([UserSeeder::class, CatatanHaidSeeder::class]);
        $user = User::query()->limit(1)->first();

        $this->put(
            '/api/catatanhaids/' . $user->id,
            [
                'start_date' => '',
                'end_date' => '2022-03-05',
                'cycle_length' => 29,
                'period_length' => 6,
                'start_prediction_date' => '2022-03-27',
                'end_prediction_date' => '2022-04-02',
                'status' => 'finished',
                'reminder_active' => false,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'start_date' => [
                        'The start date field is required.',
                    ]
                ]
            ]);
    }

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, CatatanHaidSeeder::class]);
        $user = User::query()->limit(1)->first();

        $this->delete(
            '/api/catatanhaids/' . $user->id,
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
        $this->seed([UserSeeder::class, CatatanHaidSeeder::class]);
        $user = User::query()->limit(1)->first();

        $this->delete(
            '/api/catatanhaids/' . $user->id,
            [
            ],
            [
                'Authorization' => 'test2'
            ]
        )->assertStatus(404)
            ->assertJson([
                "errors" => [
                    "message" => [
                        "unauthorized"
                    ]
                ]
            ]);
    }
}
