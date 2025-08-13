<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParameterController;

Route::post('/register', [AuthController::class, 'register']); // opsional
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


//Parameter
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/parameters', [ParameterController::class, 'index']);
    Route::post('/parameters', [ParameterController::class, 'save']);
    Route::get('/parameters/{code}', [ParameterController::class, 'view']);
    Route::put('/parameters/{code}', [ParameterController::class, 'update']);
    Route::delete('/parameters/{code}', [ParameterController::class, 'delete']);
});