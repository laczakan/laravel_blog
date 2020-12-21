<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::view('/', 'home.index');

Route::get('/auth/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/auth', [AuthController::class, 'store']);
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/category/{category}', [CategoryController::class, 'show'])->where('category', '[0-9]+');

Route::get('/users/create', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/articles', [UserController::class, 'article'])->where('user', '[0-9]+');

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article}', [ArticleController::class, 'show'])->where('article', '[0-9]+');

Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->middleware('can:add,App\Models\Article');
    Route::post('/articles', [ArticleController::class, 'store'])->middleware('can:add,App\Models\Article');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->middleware('can:update,article');
    Route::patch('/articles/{article}', [ArticleController::class, 'update'])->middleware('can:update,article');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->middleware('can:delete,article');

    Route::get('/category/create', [CategoryController::class, 'create'])->middleware('can:add,App\Models\Category');
    Route::post('/category', [CategoryController::class, 'store'])->middleware('can:add,App\Models\Category');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->middleware('can:update,category');
    Route::patch('/category/{category}', [CategoryController::class, 'update'])->middleware('can:update,category');


    Route::get('/users/{user}/image', [UserController::class, 'image'])->where('user', '[0-9]+');
    Route::post('/users/{user}/image', [UserController::class, 'storeImage'])->where('user', '[0-9]+');
    Route::delete('/users/{user}/delete', [UserController::class, 'deleteImage'])->where('user', '[0-9]+');

    Route::post('/articles/{article}/comments/', [CommentController::class, 'store']);
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware('can:update,comment');
    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->middleware('can:update,comment');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('can:delete,comment');
});







