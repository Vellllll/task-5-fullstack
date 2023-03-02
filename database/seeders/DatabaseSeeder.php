<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Article::truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Article::flushEventListeners();

        $usersQuantity = 30;
        $categoriesQuantity = 5;
        $articlesQuantity = 15;

        User::factory()->count($usersQuantity)->create();
        Category::factory()->count($categoriesQuantity)->create();
        Article::factory()->count($articlesQuantity)->create();
    }
}
