<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;


Route::get('', [HomeController::class, 'index']);

//Route::get('/', HomeController::class)->name('home');  //este es de company-app
