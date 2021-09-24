<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profil', [App\Http\Controllers\UserController::class, 'index'])->name('profil');
Route::resource('/user', App\Http\Controllers\UserController::class)->except('create');
Route::resource('/comment', App\Http\Controllers\CommentController::class);
Route::resource('/messages', App\Http\Controllers\MessageController::class);
Route::get('/search', 'App\Http\Controllers\MessageController@search')->name('messages.search');