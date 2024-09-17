<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;



Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function () {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('categories', CategoryController::class);

});

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

