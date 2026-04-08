<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/auth/redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::match(['get', 'post'], '/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $bookings = Booking::with('barber', 'service')->orderBy('booking_date', 'desc')->orderBy('booking_time', 'desc')->get();
        return view('dashboard', compact('bookings'));
    })->name('dashboard');

    Route::patch('/bookings/{booking}/status', [\App\Http\Controllers\BookingController::class, 'updateStatus'])->name('bookings.status');
    Route::delete('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');

    Route::resource('barbers', \App\Http\Controllers\BarberController::class);
    Route::resource('services', \App\Http\Controllers\ServiceController::class);
});
