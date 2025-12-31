<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Flight;
use Symfony\Component\Mailer\Transport\RoundRobinTransport;

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

// Profile
Route::middleware('auth')->group(function(){
Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index');
});

// Flights
Route::get('/flights', [FlightController::class, 'flightListPage'])
    ->name('flights.index');

Route::get('/flights/{flight}', [FlightController::class, 'flightDetailPage'])
    ->name('flights.show');

// Protected Routes
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('auth.logout');

    Route::get('/flights/{flightId}/bookings/{flightClassId}', [BookingController::class, 'createBookingPage'])
        ->name('bookings.create');

    Route::post('/flights/{flightId}/bookings/{flightClassId}', [BookingController::class, 'createBooking'])
        ->name('bookings.create');

    Route::get('/payments/{bookingId}', [PaymentController::class, 'createPaymentPage'])
        ->name('payments.create');

    Route::post('/payments/{bookingId}', [PaymentController::class, 'createPayment'])
        ->name('payments.create');

    Route::get('/payments/{bookingId}/status', [PaymentController::class, 'successPaymentPage'])
        ->name('payments.success');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [PageController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/flights', [FlightController::class, 'adminFlightListPage'])
        ->name('admin.flights.index');

    Route::get('/admin/flights/create', [FlightController::class, 'createFlightPage'])
        ->name('admin.flights.create');

    Route::post('/admin/flights/create', [FlightController::class, 'createFlight'])
        ->name('admin.flights.create');

    Route::get('/admin/flights/{flight}/edit', [FlightController::class, 'editFlightPage'])
        ->name('admin.flights.edit');

    Route::post('/admin/flights/{flight}/edit', [FlightController::class, 'editFlight'])
        ->name('admin.flights.edit');

    Route::post('/admin/flights/{flight}/delete', [FlightController::class, 'deleteFlight'])
        ->name('admin.flights.delete');
});
