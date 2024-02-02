<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\Usercontroller;
use App\Http\Controllers\CommentController;
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

//login and user route
Route::post('/register', [Usercontroller::class, 'register']);
Route::post('/login', [Usercontroller::class, 'login']);
Route::post('/logout', [Usercontroller::class, 'logout']);
Route::get('/index', [Usercontroller::class, 'index']);
Route::get('/show/{id}', [Usercontroller::class, 'show']);

Route::get('/verify/{token}/{email}', [Usercontroller::class, 'verify'])->name('verification.verify');

//product route
Route::post('/product/store', [ProductController::class, 'store'])
    ->middleware('auth:sanctum');
Route::get('/show/product/{id}', [ProductController::class, 'show']);

//comment route
Route::match(['get', 'post'], '/product/comment/{id}', [CommentController::class, 'comment'])->middleware('auth:sanctum');
Route::match(['get', 'post'], '/product/comment/show/{id}', [CommentController::class, 'show']);

//House route

Route::post('/house/store', [HouseController::class, 'store'])->middleware('auth:sanctum');
//Car route

Route::post('/car/store', [CarController::class, 'store'])->middleware('auth:sanctum');
