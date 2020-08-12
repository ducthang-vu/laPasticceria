<?php

use App\Cake_type;
use App\Http\Resources\Cake_type as Cake_typeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/cake_type', function () {
    return Cake_typeResource::collection(Cake_type::all());
});
