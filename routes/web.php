<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RutaController;

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

    Route::get('/rutas', [RutaController::class, 'index'])->name('rutas.index');
    Route::get('/rutas/create', [RutaController::class, 'create'])->name('rutas.create');
    Route::post('/rutas', [RutaController::class, 'store'])->name('rutas.store');
    Route::get('/rutas/{id}/edit', [RutaController::class, 'edit'])->name('rutas.edit');
    Route::put('/rutas/{id}', [RutaController::class, 'update'])->name('rutas.update');
    Route::delete('/rutas/{id}', [RutaController::class, 'destroy'])->name('rutas.destroy');