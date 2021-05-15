<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\PostsController::class, 'getAllPosts']);

Route::get('/posts', [App\Http\Controllers\PostsController::class, 'getAllPosts']);
Route::get('/delete-post/{id}', [App\Http\Controllers\PostsController::class, 'deletePost']);
Route::post('/add-post', [App\Http\Controllers\PostsController::class, 'addPost']);
Route::get('/edit-post/{id}', [App\Http\Controllers\PostsController::class, 'editPost']);
Route::post('/update-post', [App\Http\Controllers\PostsController::class, 'updatePost']);
Route::get('/symbols', [App\Http\Controllers\SymbolsController::class, 'ProcessSymbols'])->middleware('process.symbols');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
