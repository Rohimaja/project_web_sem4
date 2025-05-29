<?php
use App\Http\Controllers\Api\activity\AllScheduleController;
use App\Http\Controllers\Api\activity\PresenceContentController;
use App\Http\Controllers\Api\activity\TransactionController;
use App\Http\Controllers\Api\Activity\ViewProfileController;
use App\Http\Controllers\Api\Auth\ActivationAccountController;
use App\Http\Controllers\Api\Auth\ChangePasswordController;
use App\Http\Controllers\Api\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\Listview\AttendanceStudentController;
use App\Http\Controllers\Api\Listview\GetLessonController;
use App\Http\Controllers\Api\Listview\LectureStudentController;
use App\Http\Controllers\Api\Listview\PresenceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('refresh', [LoginController::class, 'refresh']);
    Route::post('forgetPassword/otp/send', [ForgetPasswordController::class, 'sendOtp']);
    Route::post('forgetPassword/otp/check', [ForgetPasswordController::class, 'checkOtp']);
    Route::post('activationAccount/otp/send', [ActivationAccountController::class, 'sendOtp']);
    Route::post('activationAccount/otp/check', [ActivationAccountController::class, 'checkOtp']);
    Route::post('activationAccount/validate', [ActivationAccountController::class, 'validateAccount']);
    Route::post('changePassword', [ChangePasswordController::class, 'changePassword']);

});

Route::middleware(['auth:api'])->group(function () {

    // Route::prefix('activityLecturer')->group(function () {
    // Route::post('lessonStudent', action[]);
    // });
    Route::prefix('activity')->group(function () {
        Route::get('viewProfile', [ViewProfileController::class, 'show']);
        Route::get('AllScheduleStudent', [AllScheduleController::class, 'scheduleStudent']);
        Route::get('AllScheduleLecturer', [AllScheduleController::class, 'scheduleLecturer']);
        Route::get('getTransaction', [TransactionController::class, 'show']);
        Route::post('presenceActivity', [PresenceContentController::class, 'store']);
    });
    Route::prefix('listview')->group(function () {
        Route::get('getLesson', [GetLessonController::class, 'getLessonStudent']);
        Route::get('getPresence', [PresenceController::class, 'getPresenceStudent']);
        Route::get('rekapPresensi', [AttendanceStudentController::class, 'index']);
        Route::get('lectureStudent', [LectureStudentController::class, 'lecture']);
        Route::get('lectureContentStudent', [LectureStudentController::class, 'lectureContent']);
    });

});