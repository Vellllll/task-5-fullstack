<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{

    public function test_get_all_articles():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/v1/articles');

        $response->assertStatus(200);
    }

    public function test_get_one_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/v1/articles/2');

        $response->assertStatus(200);
    }

    public function test_post_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/v1/articles', [
            'title' => 'Article',
            'content' => 'article content',
            'category_id' => 1,
        ]);

        $response->assertStatus(201);
    }

    public function test_update_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put('/api/v1/articles/2', [
            'title' => 'Article',
            'content' => 'article content',
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_article():void{
        $user = User::factory()->create();
        $token = $user->createToken('passport-token')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete('/api/v1/articles/2');

        $response->assertStatus(200);
    }
}
