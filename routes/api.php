<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BandController;
use App\Http\Controllers\CampingController;
use App\Http\Controllers\CampingOrderController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Mail routes
Route::post('/send-mail',[AuthController::class,'SendEmail']);

//Public routes
Route::get('/days',[DayController::class, 'index']);
Route::get('/days/{id}',[DayController::class, 'show']);


Route::get('/campings', [CampingController::class, 'index']);
Route::get('/campings/{id}', [CampingController::class, 'show']);


Route::get('/tickets', [TicketController::class, 'index']);

Route::get('/bands', [BandController::class, 'index']);
Route::get('/bands/{id}', [BandController::class, 'show']);


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
    Route::post('/camping-orders', [CampingOrderController::class, 'store']);
    Route::delete('/camping-orders/{id}', [CampingOrderController::class, 'destroy']);

    // Camping
    Route::post('/campings', [CampingController::class, 'store']);
    Route::patch('/campings/{camping}', [CampingController::class, 'update']);
    Route::delete('/campings/{id}', [CampingController::class, 'destroy']);


    //Ticket Orders
    Route::get('/ticket-orders', [TicketOrderController::class, 'index']);
    Route::get('/ticket-orders/{id}', [TicketOrderController::class, 'show']);
    Route::post('/ticket-orders', [TicketOrderController::class, 'store']);
    Route::delete('/ticket-orders/{id}', [TicketOrderController::class, 'destroy']);


    //Tickets
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::patch('/tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy']);


    //Days
    Route::post('/days', [DayController::class, 'store']);
    Route::put('/days/{id}', [DayController::class, 'update']);
    Route::delete('/days/{id}', [DayController::class, 'destroy']);


    //Bands
    Route::post('/bands', [BandController::class, 'store']);
    Route::put('/bands/{id}', [BandController::class, 'update']);
    Route::delete('/bands/{band}', [BandController::class, 'destroy']);
});

