<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\PriceController;
use App\Http\Controllers\Gallery\GalleryController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Livewire\Store\ShoppingCart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ORIGINAL
//  Route::get('/', function () {
//          return view('welcome');
//  });

Route::get('/', HomeController::class)->name('home');

//########## My Palace Ivitation ##############
// PUBLICA
Route::get('my-invite', [CustomerController::class, 'index'])->name('my-invite');  // *** PUBLICO ***//


//########## My Palace Price ##############
// PUBLICA
Route::get('price', [PriceController::class, 'index'])->name('price');  // *** PUBLICO ***//

// PUBLICA - Para Gallery de fotos
Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');  // *** PUBLICO ***//



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Livewire
Route::get('shopping-cart', ShoppingCart::class)->name('shopping-cart');


Route::get('prueba', function () {
    \Cart::destroy();
});


