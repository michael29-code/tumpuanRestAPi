<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function testRegisterSuccess()
    {
        $this->post('/api/users', [
            'username' => 'ananta',
            'password' => Hash::make('ananta'),
            'name' => 'ananta',
            'email' => 'ananta@gmail.com',
            'dob' => '2004-01-1',
            'gender' => 0,
            'role' => 0,
        ])->assertStatus(201)
        ->assertJson([
            "data" => [
                'id' => 2, // Periksa keberadaan bidang 'id'
                'username' => 'ananta',
                'name' => 'ananta',
            ]
        ]);
    }
    public function testRegisterfailed()
    {
        $this->post('/api/users', [
            'username' => '',
            'password' => '',
            'name' => ''
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "The username field is required."
                    ],
                    'password' => [
                        "The password field is required."
                    ],
                    'name' => [
                        "The name field is required."
                    ]
                ]
            ]);
    }
    public function testRegisterUsernameAlreadyExist()
    {
        // $this->testRegisterSuccess();
        $this->post('/api/users', [
            'username' => 'ananta',
            'password' => Hash::make('ananta'),
            'name' => 'ananta',
            'email' => 'test@gmail.com',
            'dob' => '2004-01-1',
            'gender' => 0,
            'role' => 0,
        ])->assertStatus(400)
            ->assertJson([
                "errors" => [
                    'username' => [
                        "username already registered"
                    ]
                ]
            ]);
    }

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);
        $this->post('/api/users/login', [
            'username' => 'test',
            'password' => 'test'
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => 'test',
                    'name' => 'test'
                ]
            ]);

        $user = User::where('username', 'test')->first();
        self::assertNotNull($user->token);
    }

    public function testLoginFailedUsernameNotFound()
    {
        $this->post('/api/users/login', [
            'username' => 'bambang',
            'password' => 'test'
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    "message" => [
                        "username or password wrong"
                    ]
                ]
            ]);
    }
}
