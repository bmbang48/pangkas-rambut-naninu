<?php

use App\Http\Controllers\BarberController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum')->name('api.user');

Route::name('api.')->group(function () {
    Route::get('/bookings/available-slots', [BookingController::class, 'availableSlots'])->name('bookings.available-slots');
    Route::get('/available-slots', [BookingController::class, 'availableSlots'])->name('available-slots'); // Alias
    Route::apiResource('barbers', BarberController::class);
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('bookings', BookingController::class);
});
