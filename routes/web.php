<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/login', [PageController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');

Route::get('/register', [PageController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])
    ->name('auth.register');

Route::get('/flights', [FlightController::class, 'index'])
    ->name('flights.index');
Route::get('/flights/{flight}', [FlightController::class, 'show'])
    ->name('flights.show');

Route::middleware('auth')->group(function () {

    Route::get('/bookings/create/{flightClass}', [BookingController::class, 'create'])
        ->name('bookings.create');

    Route::post('/bookings/confirm', [BookingController::class, 'confirm'])
        ->name('bookings.confirm');

    Route::post('/bookings/store', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::get('/bookings/success/{booking}', [BookingController::class, 'success'])
        ->name('bookings.success');
});
