<?php

namespace Tests\Feature;

use App\Models\KontakAman;
use Database\Seeders\KontakAmanSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KontakAmanTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->post(
            '/api/kontakamans',
            [
                'name' => 'Dino',
                'phoneNumber' => '081234567880',
                'relation' => 'Teman'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => 'Dino',
                    'phoneNumber' => '081234567880',
                    'relation' => 'Teman'
                ]
            ]);
    }

    public function testCreatedFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->post(
            '/api/kontakamans',
            [
                'name' => '',
                'phoneNumber' => '081234567880',
                'relation' => 'Teman'
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'name' => [
                        'The name field is required.',
                    ],
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->get('/api/kontakamans/' . $kontakaman->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Dokyeom',
                    'phoneNumber' => '081234567890',
                    'relation' => 'Pacar',
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->get('/api/kontakamans/' . ($kontakaman->id + 1), [
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

    public function testGetOtherUserContact()
    {
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->get('/api/kontakamans/' . $kontakaman->id, [
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
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();

        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->put(
            '/api/kontakamans/' . $kontakaman->id,
            [
                'name' => 'Dokyeom2',
                'phoneNumber' => '0812345678902',
                'relation' => 'Pacar2',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Dokyeom2',
                    'phoneNumber' => '0812345678902',
                    'relation' => 'Pacar2',
                ]
            ]);
    }

    public function testUpdateValidationError()
    {
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();

        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->put(
            '/api/kontakamans/' . $kontakaman->id,
            [
                'name' => '',
                'phoneNumber' => '0812345678902',
                'relation' => 'Pacar2',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'name' => [
                        'The name field is required.',
                    ]
                ]
            ]);
    }

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->delete(
            '/api/kontakamans/' . $kontakaman->id,
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
        $this->seed([UserSeeder::class, KontakAmanSeeder::class]);
        $kontakaman = KontakAman::query()->limit(1)->first();
        $this->delete(
            '/api/kontakamans/' . ($kontakaman->id + 1),
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
