<?php

namespace Tests\Feature;

use App\Models\KategoriSuaraPuan;
use Database\Seeders\KategoriSuaraPuanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriSuaraPuanTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->post('/api/kategorisuarapuans', [
            'nama' => 'Valina Evelyn',
            'deskripsi' => 'Saya suka warna biru'
        ])->assertStatus(201)
            ->assertJson([
                "data" => [
                    'nama' => 'Valina Evelyn',
                    'deskripsi' => 'Saya suka warna biru'
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->post('/api/kategorisuarapuans', [
            'nama' => '',
            'deskripsi' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    "nama" => [
                        "The nama field is required."
                    ],
                    "deskripsi" => [
                        "The deskripsi field is required."
                    ]
                ]
            ]);
    }

    public function testCreateAlreadyExists()
    {
        $this->testCreateSuccess();
        $this->post('/api/kategorisuarapuans', [
            'nama' => 'Valina Evelyn',
            'deskripsi' => 'Saya suka warna biru'
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'nama' => [
                        "Nama kategori suara puan sudah ada."
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();
        $this->get('/api/kategorisuarapuans/' . $kategorisuarapuan->id)->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nama' => 'Valina Evelyn',
                    'deskripsi' => 'Saya suka warna biru'
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();
        $this->get('/api/kategorisuarapuans/' . ($kategorisuarapuan->id + 1))->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Kategori suara puan tidak ditemukan.'
                    ]
                ]
            ]);
    }

    public function testUpdateSuccess()
    {
        $this->seed([KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();
        $this->put('/api/kategorisuarapuans/' . $kategorisuarapuan->id, [
            'nama' => 'Valina Evelyn2',
            'deskripsi' => 'Saya suka warna biru2'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nama' => 'Valina Evelyn2',
                    'deskripsi' => 'Saya suka warna biru2'
                ]
            ]);
    }

    public function testUpdateValidationError()
    {
        $this->seed([KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();
        $this->put('/api/kategorisuarapuans/' . $kategorisuarapuan->id, [
            'nama' => '',
            'deskripsi' => 'Saya suka warna biru2'
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'nama' => [
                        'The nama field is required.'
                    ]
                ]
            ]);
    }

    public function testDeleteSuccess()
    {
        $this->seed([KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();
        $this->delete('/api/kategorisuarapuans/' . $kategorisuarapuan->id)->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testDeleteNotFound()
    {
        $this->seed([KategoriSuaraPuanSeeder::class]);
        $kategorisuarapuan = KategoriSuaraPuan::query()->limit(1)->first();
        $this->delete('/api/kategorisuarapuans/' . ($kategorisuarapuan->id + 1))->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ]);
    }

}
