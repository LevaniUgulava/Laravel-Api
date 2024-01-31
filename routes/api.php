<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Usercontroller;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/login', [Usercontroller::class, 'login']);
Route::post('/logout', [Usercontroller::class, 'logout']);
Route::get('/index', [Usercontroller::class, 'index']);
Route::get('/show/{id}', [Usercontroller::class, 'show']);

Route::post('/product/store', [ProductController::class, 'store'])
    ->middleware("auth:sanctum");
Route::get('/show/product/{id}', [ProductController::class, 'show']);
