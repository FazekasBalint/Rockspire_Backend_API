<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('bands', BandsController::class);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);

