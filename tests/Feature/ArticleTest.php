<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    public function test_get_all_articles():void{
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/article/all');

        $response->assertStatus(200);

    }

    public function test_post_article():void{
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/article/store', [
            'title' => 'Article',
            'content' => 'article content',
            'category_id' => 1,
        ]);

        $response->assertRedirect('article/all');
    }

    public function test_get_article_update_page():void{
        $user = User::factory()->create();
        $article = Article::factory()->create();
        $response = $this->actingAs($user)->get('/article/update/' . $article->id . '/page');

        $response->assertStatus(200);
    }

    public function test_update_article():void{
        $user = User::factory()->create();
        $article = Article::factory()->create();
        $response = $this->actingAs($user)->put('/article/update/' . $article , [
            'title' => 'Updated article',
            'content' => 'Updated article content',
            'category_id' => 1,
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_delete_article():void{
        $user = User::factory()->create();
        $article = Article::factory()->create();
        $response = $this->actingAs($user)->delete('/article/delete/' . $article);

        $response->assertSessionHasNoErrors();
    }
}
