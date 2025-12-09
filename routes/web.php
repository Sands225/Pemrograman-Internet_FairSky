<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;

Route::get('/', [PageController::class, 'home'])->name('home');

// Login
Route::get('/login', [PageController::class, 'login'])->name('login.page');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [PageController::class, 'register'])->name('register.page');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Forgot password
Route::get('/forgot-password', [PageController::class, 'forgotPassword'])->name('password.forgot.page');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.forgot');