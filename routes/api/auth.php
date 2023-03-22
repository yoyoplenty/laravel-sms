<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('signin', [AuthController::class, 'signin']);
Route::post('signup', [AuthController::class, 'register']);
Route::post('signout', [AuthController::class, 'logout']);
Route::get('confirm_email/{token}', [AuthController::class, 'confirmEmail']);
Route::get('resend_email/{email}', [AuthController::class, 'resendEmail']);
Route::post('forgot_password', [AuthController::class, 'forgotPassword']);
Route::patch('reset_password/{token}', [AuthController::class, 'resetPassword']);
