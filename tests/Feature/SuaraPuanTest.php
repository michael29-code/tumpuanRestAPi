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
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();

        $this->post(
            '/api/kategorisuarapuans/' . $kategorisuarapuan->id . '/suarapuans',
            [
                'title' => 'test',
                'content' => 'test',
                'media' => 'test',
                'dop' => 'test',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title' => 'test',
                    'content' => 'test',
                    'media' => 'test',
                    'dop' => 'test',
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();

        $this->post(
            '/api/kategorisuarapuans/' . $kategorisuarapuan->id . '/suarapuans',
            [
                'title' => 'test',
                'content' => 'test',
                'media' => '',
                'dop' => 'test',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'media' => [
                        'The media field is required.'
                    ]
                ]
            ]);
    }

    public function testCreateContactNotFound()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();

        $this->post(
            '/api/kategorisuarapuans/' . ($kategorisuarapuan->id + 1) . '/suarapuans',
            [
                'title' => 'test',
                'content' => 'test',
                'media' => 'test',
                'dop' => 'test',
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

    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->get('/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . $suarapuan->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'title' => 'test',
                    'content' => 'test',
                    'media' => 'test',
                    'dop' => 'test',
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->get('/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . ($suarapuan->id + 1), [
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
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->put(
            '/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . $suarapuan->id,
            [
                'title' => 'update',
                'content' => 'update',
                'media' => 'update',
                'dop' => 'update',
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
                ]
            ]);
    }

    public function testUpdateFailed()
    {
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->put(
            '/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . $suarapuan->id,
            [
                'title' => 'update',
                'content' => 'update',
                'media' => 'update',
                'dop' => '',
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
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->put(
            '/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . ($suarapuan->id + 1),
            [
                'title' => 'update',
                'content' => 'update',
                'media' => 'update',
                'dop' => 'update',
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
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->delete(
            '/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . $suarapuan->id,
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
        $this->seed([UserSeeder::class, KategoriSuaraPuanSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->delete(
            '/api/kategorisuarapuans/' . $suarapuan->kategori_id . '/suarapuans/' . ($suarapuan->id + 1),
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
