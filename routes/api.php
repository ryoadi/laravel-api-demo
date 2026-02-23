<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\User\EmploymentController;
use App\Http\Controllers\Api\User\PublishEmploymentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\PublishedEmploymentController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/jobs', [PublishedEmploymentController::class, 'index']);
Route::get('/jobs/{employment}', [PublishedEmploymentController::class, 'show']);

Route::group([], function () {
    Route::post('/auth/register', RegisterController::class);
    Route::post('/auth/login', LoginController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'show']);
    Route::patch('/user', [UserController::class, 'update']);
    Route::delete('/user', [UserController::class, 'destroy']);

    // User's job post management
    Route::get('/user/jobs', [EmploymentController::class, 'index']);
    Route::post('/user/jobs', [EmploymentController::class, 'store']);
    Route::get('/user/jobs/{employment}', [EmploymentController::class, 'show']);
    Route::patch('/user/jobs/{employment}', [EmploymentController::class, 'update']);
    Route::put('/user/jobs/{employment}/published', PublishEmploymentController::class);
    Route::delete('/user/jobs/{employment}', [EmploymentController::class, 'destroy']);
});
