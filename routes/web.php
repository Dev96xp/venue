<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\PriceController;
use App\Http\Controllers\Gallery\GalleryController;
use App\Http\Controllers\Pages\About\AboutController;
use App\Http\Controllers\Pages\Ai\AiController;
use App\Http\Controllers\Pages\Chat\ChatController;
use App\Http\Controllers\Pages\Photography\PhotographyController;
use App\Http\Controllers\Pages\Store\OverviewController;
use App\Http\Controllers\Pages\Testimonial\TestimonialController;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Livewire\Store\ShoppingCart;
use App\Http\Controllers\Pages\Store\StoreController;
use App\Livewire\Pages\Store\ProductOverview;

use OpenAI\Laravel\Facades\OpenAI;

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

// PUBLICA - Testimonios
Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial');  // *** PUBLICO ***//

// PUBLICA - Para Gallery de fotos
Route::get('about', [AboutController::class, 'index'])->name('about');  // *** PUBLICO ***//

// PUBLICA - Para Photography
Route::get('photography', [PhotographyController::class, 'index'])->name('photography');  // *** PUBLICO ***//


// PUBLICA - Para Store
Route::get('store', [StoreController::class, 'index'])->name('store');  // *** PUBLICO ***//

// Livewire - ANTES
// Route::get('product-overview/{product}', ProductOverview::class)->name('product-overview');  // *** PUBLICO ***//

// Normal - AHORA LO CAMBIE  .......
Route::get('product-overview/{product}', [OverviewController::class, 'show'])->name('product-overview');  // ***aqui voy  PUBLICO ***//



// PUBLICA - Para ChatGPT - 1
Route::get('chatv', function () {
    return view('pages.chatgpt.index');
})->name('chatv');

Route::post('/chat', ChatController::class);



// PUBLICA - Para OPEN AI - 3
Route::get('/openai', [AiController::class, 'index'])->name('openai');
Route::post('/ai/make_request/', [AiController::class,'make_request'])->name('make_request');

// PUBLICA - Para OPEN AI - 4






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
    Cart::destroy();
});
