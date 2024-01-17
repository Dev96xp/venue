<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;

Route::get('', [HomeController::class, 'index'])->name('home');

// IMPORTANTE: La ruta de tipo resource, genera las 7 rutas necesarias para hacer un CRUD COMPLETO
// la SEGURIDAD DE PERMISOS se maneja desde su controlador, usando __constructor()
Route::resource('roles',RoleController::class)->names('roles');

