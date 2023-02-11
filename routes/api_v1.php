<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\BookController;
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
Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::get('/books', [BookController::class, 'list'])->middleware('auth:sanctum');
Route::post('/books', [BookController::class, 'create'])->middleware('auth:sanctum');
Route::patch('/books/{book_id}', [BookController::class, 'update'])->middleware('auth:sanctum');
