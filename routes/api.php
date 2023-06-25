<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user-platform', function (Request $request) {
        return $request->user();
    });
    Route::get('/equipment', [EquipmentController::class, 'index']);
});


Route::post('user-platform', [UserController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
