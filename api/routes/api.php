<?php

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

Route::group(['prefix' => 'albums'], function() {
    Route::get('/{album}/photos', [\App\Http\Controllers\AlbumController::class, 'photos']);
    Route::get('/{album}', [\App\Http\Controllers\AlbumController::class, 'show']);
    Route::get('/', [\App\Http\Controllers\AlbumController::class, 'index']);
});

Route::group(['prefix' => 'photos'], function() {
    Route::get('/{photo}', [\App\Http\Controllers\PhotoController::class, 'show']);
    Route::put('/{photo}', [\App\Http\Controllers\PhotoController::class, 'update']);
    Route::delete('/{photo}', [\App\Http\Controllers\PhotoController::class, 'destroy']);
});

Route::group(['prefix' => 'users'], function() {
    Route::get('/', [\App\Http\Controllers\UserController::class, 'index']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
