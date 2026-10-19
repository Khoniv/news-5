<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Group routes with 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/article', ArticleController::class);

    Route::resource('/categories', CategoryController::class)->only([
        'index',
        'store',
        'update',
        'destroy'
    ])->middleware('UserAccess:1');

    Route::resource('/config', ConfigController::class)->only([
        'index',
        'update'
    ]);

    Route::resource('/users', UserController::class);
});

// Public routes
Route::get('/about', [AboutController::class, 'about']);

Route::get('/p/{slug}', [FrontArticleController::class, 'show']);
Route::get('/articles', [FrontArticleController::class, 'index']);
Route::post('/articles/search', [FrontArticleController::class, 'index'])->name('search');
Route::get('category/{slug}', [FrontCategoryController::class, 'index']);

// Authentication routes
Auth::routes();
