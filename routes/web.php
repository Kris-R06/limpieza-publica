<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/login', [AuthController::class, 'loginForm']) ->name('login');
    Route::post('/login', [AuthController::class, 'login']) ->name('login');
    Route::post('/register', [AuthController::class, 'register']) ->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index']) ->name('home');
    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');
});