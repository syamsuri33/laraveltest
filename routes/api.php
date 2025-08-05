<?php

use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']); // opsional
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
