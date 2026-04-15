<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/home', [HomeController::class, 'index']) ->name('home');
    Route::get('/login', [AuthController::class, 'login']) ->name('login');