<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandsController;
use App\Http\Controllers\CampingController;
use App\Http\Controllers\CampingOrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Public routes
Route::post('/camping-orders', [CampingOrderController::class, 'store']);
Route::get('/campings', [CampingController::class, 'index']);
Route::get('/campings/{id}', [CampingController::class, 'show']);


//Autenthication
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


//Protected routes
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('/logout',[AuthController::class,'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Camping Orders
    Route::get('/camping-orders', [CampingOrderController::class, 'index']);
    Route::get('/camping-orders/{id}', [CampingOrderController::class, 'show']);
    Route::post('/camping-orders', [TicketOrderController::class, 'store']);
    Route::delete('/camping-orders/{id}', [CampingOrderController::class, 'destroy']);

    // Camping
    Route::post('/campings', [CampingController::class, 'store']);
    Route::put('/campings/{id}', [CampingController::class, 'update']);
    Route::delete('/campings/{id}', [CampingController::class, 'destroy']);


    //Ticket Orders
    Route::get('/ticket-orders', [TicketOrderController::class, 'index']);
    Route::get('/ticket-orders/{id}', [CampingOrderController::class, 'show']);
    Route::post('/ticket-orders', [TicketOrderController::class, 'store']);
    Route::delete('/ticket-orders/{id}', [TicketOrderController::class, 'destroy']);


    //Tickets
    Route::get('/tickets', [TicketController::class, 'index']);
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::put('/tickets/{id}', [TicketController::class, 'update']);
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy']);

});

