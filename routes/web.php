<?php

use App\Http\Controllers\EncounterController;
use App\Http\Controllers\EnemyController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\RegionController;
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
    return view('welcome');
});

Route::controller(EnvironmentController::class)->group(function () {
    Route::get('/environment', 'index');
    Route::get('/environment/create', 'create');
    Route::get('/environment/{environment}', 'show');
    Route::get('/environment/{environment}/edit', 'edit');
    Route::post('/environment', 'store');
    Route::patch('/environment/{environment}/update', 'update');
    Route::delete('/environment/{environment}/delete', 'destroy');
});

Route::controller(RegionController::class)->group(function () {
    Route::get('/region', 'index');
    Route::get('/region/create', 'create');
    Route::get('/region/{region}', 'show');
    Route::get('/region/{region}/edit', 'edit');
    Route::post('/region', 'store');
    Route::patch('/region/{region}/update', 'update');
    Route::delete('/region/{region}/delete', 'destroy');
});

Route::controller(EnemyController::class)->group(function () {
    Route::get('/enemy', 'index');
    Route::get('/enemy/create', 'create');
    Route::get('/enemy/{enemy}', 'show');
    Route::get('/enemy/{enemy}/edit', 'edit');
    Route::post('/enemy', 'store');
    Route::patch('/enemy/{enemy}/update', 'update');
    Route::delete('/enemy/{enemy}/delete', 'destroy');
});

Route::controller(EncounterController::class)->group(function () {
    Route::get('/encounter', 'index');
    Route::get('/encounter/create', 'create');
    Route::get('/encounter/{encounter}', 'show');
    Route::get('/encounter/{encounter}/edit', 'edit');
    Route::post('/encounter', 'store');
    Route::patch('/encounter/{encounter}/update', 'update');
    Route::delete('/encounter/{encounter}/delete', 'destroy');
});
