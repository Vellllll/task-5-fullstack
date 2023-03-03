<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('user.logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(ArticleController::class)->group(function(){
        Route::get('/article/all', 'allArticles')->name('articles.all');
        Route::post('/article/store', 'storeArticle')->name('article.store');
        Route::get('/article/update/{id}/page', 'updateArticlePage')->name('article.update.page');
        Route::post('/article/update/{article}', 'updateArticle')->name('article.update');
        Route::get('/article/delete/{article}', 'deleteArticle')->name('article.delete');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/category/all', 'allCategories')->name('categories.all');
        Route::post('/category/store', 'storeCategory')->name('category.store');
        Route::get('/category/update/{id}/page', 'updateCategoryPage')->name('category.update.page');
        Route::post('/category/update/{category}', 'updateCategory')->name('category.update');
        Route::get('/category/delete/{category}', 'deleteCategory')->name('category.delete');
    });
});

require __DIR__.'/auth.php';
