<?php

use App\Http\Controllers\{Auth\AuthController,
    CourseController,
    LessonController,
    ModuleController,
    ReplySupportController,
    SupportController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/courses/{id}/modules', [ModuleController::class, 'index']);

    Route::get('/modules/{id}/lessons', [LessonController::class, 'index']);

    Route::get('/my-supports', [SupportController::class, 'index']);
    Route::get('/supports', [SupportController::class, 'mySupports']);
    Route::post('/supports', [SupportController::class, 'store']);

    Route::post('/replies', [ReplySupportController::class, 'store']);
});

Route::get('/', function () {
    return response()->json([
        'success' => true,
    ]);
});
