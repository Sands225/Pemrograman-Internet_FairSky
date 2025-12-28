<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

Route::get('/', [PageController::class, 'home'])->name('home');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [PageController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [PageController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

// Flights
Route::get('/flights', [FlightController::class, 'index'])
    ->name('flights.index');

Route::get('/flights/{flight}', [FlightController::class, 'show'])
    ->name('flights.show');

Route::get('/flights', [FlightController::class, 'index'])
    ->name('flights.search');

Route::get('/flights/{flight}', [FlightController::class, 'show'])
    ->name('flights.show');

// Protected Routes
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout');

    Route::get('/bookings/create/{flightClass}', [BookingController::class, 'create'])
        ->name('bookings.create');

    Route::post('/bookings/confirm', [BookingController::class, 'confirm'])
        ->name('bookings.confirm');

    Route::post('/bookings/store', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::get('/bookings/success/{booking}', [BookingController::class, 'success'])
        ->name('bookings.success');
});
