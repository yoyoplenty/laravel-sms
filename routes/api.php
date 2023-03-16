<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/roles.php';
    require __DIR__ . '/api/users.php';
    require __DIR__ . '/api/grades.php';
    require __DIR__ . '/api/subjects.php';
    require __DIR__ . '/api/students.php';
    require __DIR__ . '/api/teachers.php';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
