<?php

namespace Tests\Feature;

use App\Models\KategoriUntukPuan;
use Database\Seeders\KategoriUntukPuanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KategoriUntukPuanTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(201);
    // }

    public function testCreateSuccess()
    {
        $this->post('/api/kategoriuntukpuans', [
            'nama_kategori' => 'Casual',
            'deskripsi' => 'Kategori Casual Untuk Puan'
        ])->assertStatus(201)
        ->assertJson([
            "data" => [
                'nama_kategori' => 'Casual',
                'deskripsi' => 'Kategori Casual Untuk Puan'
            ]
        ]);
    }

    public function testCreateFailed()
    {
        $this->post('/api/kategoriuntukpuans', [
            'nama_kategori' => '',
            'deskripsi' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    "nama_kategori" => [
                        "The nama kategori field is required."
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
        $this->post('/api/kategoriuntukpuans', [
            'nama_kategori' => 'Casual',
            'deskripsi' => 'Kategori Teknologi Untuk Puan'
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'nama_kategori' => [
                        "Nama kategori untuk puan sudah ada."
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $this->seed([KategoriUntukPuanSeeder::class]);
        $kategoriuntukpuan = KategoriUntukPuan::query()->limit(1)->first();
        // dd($kategoriuntukpuan);
        $this->get('/api/kategoriuntukpuans/' . $kategoriuntukpuan->id)->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nama_kategori' => 'Teknologi',
                    'deskripsi' => 'Kategori Teknologi Untuk Puan'
                ]
            ]);
    }
    public function testGetNotFound()
    {
        $this->seed([KategoriUntukPuanSeeder::class]);
        $kategoriuntukpuan = KategoriUntukPuan::query()->limit(1)->first();
        $this->get('/api/kategoriuntukpuans/' . ($kategoriuntukpuan->id + 1))->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'Kategori Untuk puan tidak ditemukan.'
                    ]
                ]
            ]);
    }

    public function testUpdateSuccess()
    {
        $this->seed([KategoriUntukPuanSeeder::class]);
        $kategoriuntukpuan = KategoriUntukPuan::query()->limit(1)->first();
        $this->put('/api/kategoriuntukpuans/' . $kategoriuntukpuan->id, [
            'nama_kategori' => 'Teknologi2',
            'deskripsi' => 'Kategori Teknologi2 untuk puan'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nama_kategori' => 'Teknologi2',
                    'deskripsi' => 'Kategori Teknologi2 untuk puan'
                ]
            ]);
    }

    public function testUpdateValidationError()
    {
        $this->seed([KategoriUntukPuanSeeder::class]);
        $kategoriuntukpuan = KategoriUntukPuan::query()->limit(1)->first();
        $this->put('/api/kategoriuntukpuans/' . $kategoriuntukpuan->id, [
            'nama_kategori' => '',
            'deskripsi' => 'Kategori Teknologi2 untuk puan'
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'nama_kategori' => [
                    'The nama kategori field is required.'
                    ]
                ]
            ]);
    }

    public function testDeleteSuccess()
    {
        $this->seed([KategoriUntukPuanSeeder::class]);
        $kategoriuntukpuan = KategoriUntukPuan::query()->limit(1)->first();
        $this->delete('/api/kategoriuntukpuans/' . $kategoriuntukpuan->id)->assertStatus(201)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testDeleteNotFound()
    {
        $this->seed([KategoriUntukPuanSeeder::class]);
        $kategoriuntukpuan = KategoriUntukPuan::query()->limit(1)->first();
        $this->delete('/api/kategoriuntukpuans/' . ($kategoriuntukpuan->id + 1))->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'not found'
                    ]
                ]
            ]);
    }
}
