<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FlightController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::get('/register', [PageController::class, 'register'])->name('register');
