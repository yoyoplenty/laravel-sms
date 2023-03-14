<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group(function () {
//     Route::get('users', [UserController::class, 'index'])->withoutMiddleware('auth');
//     Route::get('users/{user}', [UserController::class, 'show'])->whereNumber('user');
// });

Route::apiResource('users', UserController::class);
