<?php

namespace Tests\Feature;

use App\Models\Role;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function testCreateSuccess()
    {
        $this->seed([UserSeeder::class]);

        $this->post('/api/roles', [
            'nama_role' => 'Untuk Puan',
            'deskripsi' => 'Admin Untuk Puan',
        ], [
            'Authorization' => 'test'
        ])->assertStatus(201)
            ->assertJson([
                'data' => [
                    'nama_role' => 'Untuk Puan',
                    'deskripsi' => 'Admin Untuk Puan',
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $this->seed([UserSeeder::class]);

        $this->post('/api/roles', [
            'nama_role' => '',
            'deskripsi' => '',
        ], [
            'Authorization' => 'test'
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'nama_role' => [
                        'The nama role field is required.'
                    ],
                    'deskripsi' => [
                        'The deskripsi field is required.'
                    ],
                ]
            ]);
    }

    public function testCreateUnauthorized()
    {
        $this->seed([UserSeeder::class]);

        $this->post('/api/roles', [
            'nama_role' => 'Untuk Puan',
            'deskripsi' => 'Admin Untuk Puan',
        ], [
            'Authorization' => 'asdfasdf'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => [
                        'unauthorized'
                    ]
                ]
            ]);
    }


    public function testGetSuccess()
    {
        $this->seed([UserSeeder::class, RoleSeeder::class]);
        $role = Role::query()->limit(1)->first();

        $this->get('/api/roles/' . $role->id, [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nama_role' => 'User',
                    'deskripsi' => 'role user',
                ]
            ]);
    }

    public function testGetNotFound()
    {
        $this->seed([UserSeeder::class, RoleSeeder::class]);
        $role = Role::query()->limit(1)->first();

        $this->get('/api/roles/' . ($role->id + 1), [
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
        $this->seed([UserSeeder::class, RoleSeeder::class]);

        $role = Role::query()->limit(1)->first();

        $this->put('/api/roles/' . $role->id, [
            'nama_role' => 'Suara Puan',
            'deskripsi' => 'Admin Suara Puan',
        ], [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nama_role' => 'Suara Puan',
                    'deskripsi' => 'Admin Suara Puan',
                ]
            ]);
    }

    public function testUpdateValidationError()
    {
        $this->seed([UserSeeder::class, RoleSeeder::class]);

        $role = Role::query()->limit(1)->first();

        $this->put('/api/roles/' . $role->id, [
            'nama_role' => '',
            'deskripsi' => 'Admin Untuk Puan',
        ], [
            'Authorization' => 'test'
        ])->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'nama_role' => [
                        'The nama role field is required.'
                    ]
                ]
            ]);
    }

    public function testDeleteSuccess()
    {
        $this->seed([UserSeeder::class, RoleSeeder::class]);

        $role = Role::query()->limit(1)->first();

        $this->delete('/api/roles/' . $role->id, [], [
            'Authorization' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testDeleteNotFound()
    {
        $this->seed([UserSeeder::class, RoleSeeder::class]);

        $role = Role::query()->limit(1)->first();

        $this->delete('/api/roles/' . ($role->id + 1), [], [
            'Authorization' => 'test'
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ]);
    }
}
