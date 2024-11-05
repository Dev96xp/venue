<?php

use App\Http\Controllers\Photography\PhotographyController;
use Illuminate\Support\Facades\Route;


//########## My Images Dropdown ##############
// PRIVADA PARA LA GENTE AUTENTIFICADA
Route::get('my-images', [PhotographyController::class, 'index'])->name('my-images');  // *** PUBLICO ***//
