<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ServicePlatformController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user-platform', function (Request $request) {
        return $request->user();
    });

    Route::get('/service-platform/{id}', [ServicePlatformController::class, 'show']);
    Route::get('/service-platform', [ServicePlatformController::class, 'index']);
    Route::post('/service-platform', [ServicePlatformController::class, 'store']);
    Route::patch('/service-platform/{id}', [ServicePlatformController::class, 'update']);
    Route::delete('/service-platform/{id}', [ServicePlatformController::class, 'delete']);
   
    Route::get('/equipment', [EquipmentController::class, 'index']);
});


Route::post('user-platform', [UserController::class, 'store']);
Route::post('login', [AuthController::class, 'login']);
