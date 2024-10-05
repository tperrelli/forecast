<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LocationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'locations', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/search', [LocationController::class, 'search']);
    Route::delete('/delete/{id}', [LocationController::class, 'destroy']);
});
