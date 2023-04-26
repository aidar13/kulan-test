<?php

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
Route::post('/register', [RegisterController::class, '__invoke'])->name('register');
