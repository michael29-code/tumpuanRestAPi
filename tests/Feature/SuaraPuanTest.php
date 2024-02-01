<?php

namespace Tests\Feature;

use App\Models\KategoriSuaraPuan;
use App\Models\SuaraPuan;
use Database\Seeders\KategoriSuaraPuanSeeder;
use Database\Seeders\SuaraPuanSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SuaraPuanTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class]);
        $kategori = KategoriSuaraPuan::first();

        $this->post(
            '/api/suarapuans',
            [
                'title' => 'blabla',
                'content' => 'blabla',
                'media' => 'blabla',
                'dop' => 'blabla',
                'kategori_id' => $kategori->id,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'blabla',
                    'content' => 'blabla',
                    'media' => 'blabla',
                    'dop' => 'blabla',
                    'kategori_id' => $kategori->id,
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class]);
        $kategori = KategoriSuaraPuan::first();

        $this->post(
            '/api/suarapuans',
            [
                'title' => 'blabla',
                'content' => 'blabla',
                'media' => 'blabla',
                'dop' => '',
                'kategori_id' => $kategori->id,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'dop' => [
                        'The dop field is required.'
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $kategori = KategoriSuaraPuan::first();

        $this->get('/api/suarapuans/' . $suarapuan->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => 'test',
                    'content' => 'test',
                    'media' => 'test',
                    'dop' => 'test',
                    'kategori_id' => $kategori->id,
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $kategori = KategoriSuaraPuan::first();

        $this->get('/api/suarapuans/' . ($suarapuan->id + 1), [
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
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $kategori = KategoriSuaraPuan::first();

        $this->put(
            '/api/suarapuans/' . $suarapuan->id,
            [
                'title' => 'update',
                'content' => 'update',
                'media' => 'update',
                'dop' => 'update',
                'kategori_id' => $kategori->id,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => 'update',
                    'content' => 'update',
                    'media' => 'update',
                    'dop' => 'update',
                    'kategori_id' => $kategori->id,
                ]
            ]);
    }

    public function testUpdateFailed()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $kategori = KategoriSuaraPuan::first();

        $this->put(
            '/api/suarapuans/' . $suarapuan->id,
            [
                'title' => 'update',
                'content' => 'update',
                'media' => 'update',
                'dop' => '',
                'kategori_id' => $kategori->id,
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'dop' => [
                        'The dop field is required.'
                    ]
                ]
            ]);
    }

    public function testUpdateNotFound()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $kategori = KategoriSuaraPuan::first();

        $this->put(
            '/api/suarapuans/' . ($suarapuan->id + 1),
            [
                'title' => 'update',
                'content' => 'update',
                'media' => 'update',
                'dop' => 'update',
                'kategori_id' => $kategori->id,
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

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $this->delete(
            '/api/suarapuans/' . $suarapuan->id,
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
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();
        $this->delete(
            '/api/suarapuans/' . ($suarapuan->id + 1),
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
