<?php

use App\Http\Controllers\Account\AccountController;
use Illuminate\Support\Facades\Route;


//########## My Palace Card ##############
// PRIVADA PARA LA GENTE AUTENTIFICADA
Route::get('my-account', [AccountController::class, 'index'])->name('my-account');  // *** PUBLICO ***//
