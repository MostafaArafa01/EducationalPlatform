<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::apiResource('/user',UserController::class)->except('store');
    Route::post('/logout',[LogoutController::class,'logout']);
    Route::apiResource('/course',CourseController::class);
    Route::apiResource('/lesson',LessonController::class);
});
Route::apiResource('/user',UserController::class)->only('store');
Route::post('/login',[LoginController::class,'login']);

