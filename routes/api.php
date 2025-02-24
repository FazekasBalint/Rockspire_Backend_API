<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Public routes

//Autenthication
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


//Protected routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

