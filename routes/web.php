<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\TipoUnidadController;
use App\Http\Controllers\TipoTrabajadorController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/login', [AuthController::class, 'loginForm']) ->name('login');
    Route::post('/login', [AuthController::class, 'login']) ->name('login');
    Route::post('/register', [AuthController::class, 'register']) ->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index']) ->name('home');
    Route::post('/logout', [AuthController::class, 'logout']) ->name('logout');

    #Rutas para la gestión de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    #Rutas para la gestión de rutas
    Route::get('/rutas', [RutaController::class, 'index'])->name('rutas.index');
    Route::get('/rutas/create', [RutaController::class, 'create'])->name('rutas.create');
    Route::post('/rutas', [RutaController::class, 'store'])->name('rutas.store');
    Route::get('/rutas/{id}/edit', [RutaController::class, 'edit'])->name('rutas.edit');
    Route::put('/rutas/{id}', [RutaController::class, 'update'])->name('rutas.update');
    Route::delete('/rutas/{id}', [RutaController::class, 'destroy'])->name('rutas.destroy');

    #Rutas para la gestión de turnos
    Route::get('/turnos', [TurnoController::class, 'index'])->name('turnos.index');
    Route::get('/turnos/create', [TurnoController::class, 'create'])->name('turnos.create');
    Route::post('/turnos', [TurnoController::class, 'store'])->name('turnos.store');
    Route::get('/turnos/{id}/edit', [TurnoController::class, 'edit'])->name('turnos.edit');
    Route::put('/turnos/{id}', [TurnoController::class, 'update'])->name('turnos.update');
    Route::delete('/turnos/{id}', [TurnoController::class, 'destroy'])->name('turnos.destroy');

    #Rutas para la gestión de tipos de unidad
    Route::get('/tipo_unidades', [TipoUnidadController::class, 'index'])->name('tipo_unidades.index');
    Route::get('/tipo_unidades/create', [TipoUnidadController::class, 'create'])->name('tipo_unidades.create');
    Route::post('/tipo_unidades', [TipoUnidadController::class, 'store'])->name('tipo_unidades.store');
    Route::get('/tipo_unidades/{id}/edit', [TipoUnidadController::class, 'edit'])->name('tipo_unidades.edit');
    Route::put('/tipo_unidades/{id}', [TipoUnidadController::class, 'update'])->name('tipo_unidades.update');
    Route::delete('/tipo_unidades/{id}', [TipoUnidadController::class, 'destroy'])->name('tipo_unidades.destroy');

    #Rutas para la gestión de tipos de trabajador
    Route::get('/tipo_trabajadores', [TipoTrabajadorController::class, 'index'])->name('tipo_trabajadores.index');
    Route::get('/tipo_trabajadores/create', [TipoTrabajadorController::class, 'create'])->name('tipo_trabajadores.create');
    Route::post('/tipo_trabajadores', [TipoTrabajadorController::class, 'store'])->name('tipo_trabajadores.store');
    Route::get('/tipo_trabajadores/{id}/edit', [TipoTrabajadorController::class, 'edit'])->name('tipo_trabajadores.edit');
    Route::put('/tipo_trabajadores/{id}', [TipoTrabajadorController::class, 'update'])->name('tipo_trabajadores.update');
    Route::delete('/tipo_trabajadores/{id}', [TipoTrabajadorController::class, 'destroy'])->name('tipo_trabajadores.destroy');
});
