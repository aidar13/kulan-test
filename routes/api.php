<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::post('/register', RegisterController::class)->name('register');


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
});
