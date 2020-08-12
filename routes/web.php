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

Route::get('/', function () {
    return view('home');
})->name('home');


Auth::routes(['register' => false]);

Route::prefix('user')
    ->name('user.')
    ->namespace('user')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', function() {return view('user.home');})->name('home');
        Route::resource('cake_types', 'CakeTypeController')->parameters(['cake_types' => 'slug']);
        Route::get('cake_types/id/{id}', 'CakeTypeController@redirectShow')->name('cake_type.id');
        Route::resource('cakes', 'CakeController')->except(['edit', 'update', 'show']);
        Route::resource('ingredients', 'IngredientController')->only(['index', 'store', 'destroy']);
    });
