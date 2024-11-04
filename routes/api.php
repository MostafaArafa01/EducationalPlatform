<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::apiResource('/user',UserController::class)->except('store');
});
Route::apiResource('/user',UserController::class)->only('store');
Route::post('/login',[LoginController::class,'login']);
Route::post('/logout',[LogoutController::class,'logout'])->middleware('auth:sanctum');
