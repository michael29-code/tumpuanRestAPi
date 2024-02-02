<?php

namespace Tests\Feature;

use App\Models\CommentPuan;
use App\Models\SuaraPuan;
use Database\Seeders\CommentPuanSeeder;
use Database\Seeders\SuaraPuanSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentPuanTest extends TestCase
{
    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->post(
            '/api/suarapuans/' . $suarapuan->id . '/commentpuans',
            [
                'comment' => 'test',
                'dop' => 'test',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(201)
            ->assertJson([
                'data' => [
                    'comment' => 'test',
                    'dop' => 'test',
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->post(
            '/api/suarapuans/' . $suarapuan->id . '/commentpuans',
            [
                'comment' => '',
                'dop' => 'test',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'comment' => [
                        'The comment field is required.'
                    ]
                ]
            ]);
    }

    public function testCreateNotFound()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class]);
        $suarapuan = SuaraPuan::query()->limit(1)->first();

        $this->post(
            '/api/suarapuans/' . ($suarapuan->id + 1) . '/commentpuans',
            [
                'comment' => 'test',
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
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->get('/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . $commentpuan->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'comment' => $commentpuan->comment,
                    'dop' => $commentpuan->dop,
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->get('/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . ($commentpuan->id + 1), [
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
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->put(
            '/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . $commentpuan->id,
            [
                'comment' => 'update',
                'dop' => 'update',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(200)
            ->assertJson([
                'data' => [
                    'comment' => 'update',
                    'dop' => 'update',
                ]
            ]);
    }

    public function testUpdateFailed()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->put(
            '/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . $commentpuan->id,
            [
                'comment' => '',
                'dop' => 'update',
            ],
            [
                'Authorization' => 'test'
            ]
        )->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'comment' => [
                        'The comment field is required.'
                    ],
                ]
            ]);
    }

    public function testUpdateNotFound()
    {
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->put(
            '/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . ($commentpuan->id + 1),
            [
                'comment' => 'update',
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
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->delete(
            '/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . $commentpuan->id,
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
        $this->seed([UserSeeder::class, SuaraPuanSeeder::class, CommentPuanSeeder::class]);
        $commentpuan = CommentPuan::query()->limit(1)->first();

        $this->delete(
            '/api/suarapuans/' . $commentpuan->suarapuan_id . '/commentpuans/' . ($commentpuan->id + 1),
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
