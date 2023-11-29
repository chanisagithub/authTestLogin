<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('user', [AuthController::class, 'getUser']);
Route::post('test', [AuthController::class, 'test']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('authTest', [AuthController::class, 'authTest']);
    Route::post('authTest', [AuthController::class, 'authTest']);
    
    Route::post('logout', [AuthController::class, 'logout']);

});



