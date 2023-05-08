<?php

use App\Http\Controllers\{CourseController, ModuleController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/courses/{id}/modules', [ModuleController::class, 'index']);
//Route::get('/courses/{id}/modules/{id}', [ModuleController::class, 'show']);

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});
