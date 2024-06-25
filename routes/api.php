<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::POST('/user_add',[ApiController::class , 'create']);
Route::get('/users',[ApiController::class , 'show']);
Route::get('/user/{id}',[ApiController::class , 'showbyid']);
Route::put('/userupdate/{id}',[ApiController::class , 'update']);
Route::delete('/userdelete/{id}',[ApiController::class , 'deletebyId']);