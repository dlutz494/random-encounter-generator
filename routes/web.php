<?php

use App\Http\Controllers\EnvironmentController;
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
    Route::post('/environment', 'store');
    Route::get('/environment/create', 'create');
    Route::get('/environment/{environment}', 'show');
    Route::get('/environment/{environment}/edit', 'edit');
    Route::patch('/environment/{environment}/update', 'update');
});
