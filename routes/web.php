<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\user\CakeController;
use App\Http\Controllers\user\CakeTypeController;
use App\Http\Controllers\user\IngredientController;

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
    ->middleware('auth')
    ->group(function () {
        Route::get('/', fn () => view('user.home'))->name('home');
        Route::resource('cake_types', CakeTypeController::class)->parameters(['cake_types' => 'slug']);
        Route::get('cake_types/id/{id}', [CakeTypeController::class, 'redirectShow'])->name('cake_type.id');
        Route::resource('cakes', CakeController::class)->except(['edit', 'update', 'show']);
        Route::resource('ingredients', IngredientController::class)->only(['index', 'store', 'destroy']);
    });
