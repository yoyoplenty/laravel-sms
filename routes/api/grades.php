<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('grades', GradeController::class);
