<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('signin', [AuthController::class, 'signin']);
Route::post('signup', [AuthController::class, 'register']);
Route::post('signout', [AuthController::class, 'logout']);
