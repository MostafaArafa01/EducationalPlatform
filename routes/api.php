<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\CompleteLessonController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\FilterCoursesController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PurchaseCourseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::apiResource('/user',UserController::class)->except('store');
    Route::post('/logout',[LogoutController::class,'logout']);
    Route::apiResource('/course',CourseController::class)->except('index');
    Route::apiResource('/lesson',LessonController::class);
    Route::apiResource('/enrollment',EnrollmentController::class);
    Route::post('/complete-lesson',CompleteLessonController::class);
    Route::post('purchase',PurchaseCourseController::class);
});
Route::apiResource('/user',UserController::class)->only('store');
Route::post('/login',[LoginController::class,'login']);
Route::apiResource('/course',CourseController::class)->only('index');
Route::get('/filter',FilterCoursesController::class);


