<?php

use App\Http\Controllers\EncounterResourceController;
use App\Http\Controllers\EnemyResourceController;
use App\Http\Controllers\EnvironmentResourceController;
use App\Http\Controllers\RegionResourceController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('region', RegionResourceController::class);
Route::apiResource('environment', EnvironmentResourceController::class);
Route::apiResource('enemy', EnemyResourceController::class);
Route::apiResource('encounter', EncounterResourceController::class);
