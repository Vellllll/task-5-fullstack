<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function test_user_can_login(): void{
        $response = $this->post('/api/login', [
            'email' => 'suzy@kmail.com',
            'password' => 'suzy123',
        ])->assertOk();

        $response->assertStatus(200);
    }

    public function test_register_user():void{
        $response = $this->post('/api/register', [
            'name' => 'New user',
            'email' => 'newuser@gmail.com',
            'password' => 'newuser123',
        ])->assertOk();

        $response->assertStatus(200);
    }

    public function test_user_logout():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        $response->assertStatus(200);
    }


}
