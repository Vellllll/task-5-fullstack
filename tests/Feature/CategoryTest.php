<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_get_all_categories():void{
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/category/all');

        $response->assertStatus(200);

    }

    public function test_post_category():void{
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/category/store', [
            'name' => 'category',
        ]);

        $response->assertRedirect('category/all');
    }

    public function test_get_category_update_page():void{
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->get('/category/update/' . $category->id . '/page');

        $response->assertStatus(200);
    }

    public function test_update_category():void{
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->put('/category/update/' . $category , [
            'name' => 'Updated category',
        ]);

        $response->assertSessionHasNoErrors();
    }

    public function test_delete_category():void{
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $response = $this->actingAs($user)->delete('/category/delete/' . $category);

        $response->assertSessionHasNoErrors();
    }
}
