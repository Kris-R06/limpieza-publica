<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\ColoniaController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/login', [AuthController::class, 'loginForm']) ->name('login');
    Route::post('/login', [AuthController::class, 'login']) ->name('login');
    Route::post('/register', [AuthController::class, 'register']) ->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index']) ->name('home');
    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');

    #Rutas para la gestión de rutas
    Route::get('/rutas', [RutaController::class, 'index'])->name('rutas.index');
    Route::get('/rutas/create', [RutaController::class, 'create'])->name('rutas.create');
    Route::post('/rutas', [RutaController::class, 'store'])->name('rutas.store');
    Route::get('/rutas/{id}/edit', [RutaController::class, 'edit'])->name('rutas.edit');
    Route::put('/rutas/{id}', [RutaController::class, 'update'])->name('rutas.update');
    Route::delete('/rutas/{id}', [RutaController::class, 'destroy'])->name('rutas.destroy');

    #Rutas para la gestión de colonias
    Route::get('/colonias', [ColoniaController::class, 'index'])->name('colonias.index');
    Route::get('/colonias/create', [ColoniaController::class, 'create'])->name('colonias.create');
    Route::post('/colonias', [ColoniaController::class, 'store'])->name('colonias.store');
    Route::get('/colonias/{id}/edit', [ColoniaController::class, 'edit'])->name('colonias.edit');
    Route::put('/colonias/{id}', [ColoniaController::class, 'update'])->name('colonias.update');
    Route::delete('/colonias/{id}', [ColoniaController::class, 'destroy'])->name('colonias.destroy');
});
