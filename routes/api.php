<?php

use App\Http\Controllers\ParkingSlotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('slot/status/{id}', [ParkingSlotController::class, 'slotStatus']);
Route::post('slot/update', [ParkingSlotController::class, 'slotUpdate']);
