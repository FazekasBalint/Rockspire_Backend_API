<?php

use App\Http\Controllers\BandsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('bands', BandsController::class);
