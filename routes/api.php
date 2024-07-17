<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\AuthController;

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

// Authentification API avec Sanctum
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes protégées avec permissions
Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(['permission:manage regions'])->group(function () {
        Route::apiResource('regions', RegionController::class);
    });

    Route::middleware(['permission:manage centres'])->group(function () {
        Route::apiResource('centres', CentreController::class);
    });

    Route::middleware(['permission:manage participants'])->group(function () {
        Route::apiResource('participants', ParticipantController::class);
    });
});
