<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

//register
Route::post('/register', [UserController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);
//logut
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//user:list
Route::get('/users', [UserController::class, 'userList'])->middleware(['auth:sanctum', 'abilities:user:list']);
//user:detail
Route::get('/users/{user}', [UserController::class, 'detail'])->middleware('auth:sanctum');
//update
Route::put('/users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'abilities:user:update']);
//delete
Route::delete('/users/{user}', [UserController::class, 'delete'])->middleware(['auth:sanctum', 'abilities:user:delete']);
