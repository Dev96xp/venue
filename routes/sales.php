<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Store\CreateOrder;
use App\Livewire\Store\Payment\PaymentOrder;
use App\Http\Controllers\Inviter\OrderController;


// PAGINA PRODUCTOS - ORDENES EN LINEA
// Un grupo de rutas, que solicitan al usuario ser autentificado, por un middleware, para usarse estas rutas

Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
// Que solo los usuarios autentificados pueden poner una orden
Route::get('orders/create', CreateOrder::class)->name('orders.create');
Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('orders/{order}/payment', PaymentOrder::class)->name('orders.payment');
