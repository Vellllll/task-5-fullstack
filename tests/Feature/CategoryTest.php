<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_all_articles():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/v1/categories');

        $response->assertStatus(200);
    }

    public function test_get_one_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/v1/categories/2');

        $response->assertStatus(200);
    }

    public function test_post_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/categories', [
            'name' => 'New category',
            'user_id' => $user->id,
        ]);

        $response->assertStatus(201);
    }

    public function test_update_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/v1/categories/2', [
            'name' => 'Category',
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/v1/categories/2');

        $response->assertStatus(200);
    }
}
