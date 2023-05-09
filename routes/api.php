<?php

use App\Http\Controllers\{
    CourseController,
    LessonController,
    ModuleController,
    ReplySupportController,
    SupportController};

use App\Http\Controllers\Auth\{
    AuthController,
    ResetPasswordController};

use Illuminate\Support\Facades\Route;

/*
 * Auth
 */
Route::post('/auth', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

/*
 * Reset password
 */
Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest');


/*
 * Api
 */
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
