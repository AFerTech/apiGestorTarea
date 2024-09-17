<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

Route::get('/', function (Request $request) {
    return 'desde api';
})->middleware('auth:sanctum');


Route::apiResource('tasks', TaskController::class);
Route::apiResource('categories', CategoryController::class);

// auth
Route::post('/register',[AuthController::class, 'register']);
