<?php
use App\Http\Controllers\Api\Listview\GetLesson;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
});

// Route::prefix('activityLecturer')->group(function () {
// Route::post('lessonStudent', action[]);
// });
// Route::prefix('activity')->group(function () {
// Route::post('lessonStudent', action[]);
// });
Route::prefix('listview')->group(function () {
    Route::get('lessonStudent', [GetLesson::class, 'getLessonStudent']);
});