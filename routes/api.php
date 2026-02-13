<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/jobs');
Route::get('/jobs/{job}');

Route::can('login')->group(function () {
    Route::post('/auth/register');
    Route::post('/auth/login', [AuthController::class, 'login']);
});

Route::can('view-account', User::class)->group(function () {
    Route::get('/user', fn (Request $request) => $request->user()->toResource());
    Route::patch('/user');
    Route::delete('/user');

    // User's job post management
    Route::get('/user/jobs');
    Route::post('/user/jobs');
    Route::get('/user/jobs/{job}');
    Route::patch('/user/jobs/{job}');
    Route::delete('/user/jobs/{job}');
});
