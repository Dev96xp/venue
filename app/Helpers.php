<?php
// HELPERS
// Todas la funciones aqui agregadas son llamadas helpers,
// y estas funciones se pueden accesar desde cualquier punto de nuestra app
// Para que funciones adecuadamente este archivo fue declarado en nuestro archivo (composer.json)
// de la siguiente manera en la seccion de (autoload)

// "files": [
//     "app/Helpers/OrderHelper.php"
// ]

use App\Models\Product;
use App\Models\Size;
use Gloudemans\Shoppingcart\Facades\Cart;
use PayPal\Api\Item;

//Se supone que actualiza el inventario, pero no sirve y por tanto no se usa en este mpomento



// Cantida de productos agregados a nuestro carrito de compras
function qty_added($product_id, $color_id = null, $size_id = null)
{

    // Todos los item en nuestro carrito de compras
    $cart = Cart::content();

    $item = $cart->where('id', $product_id)
        ->where('option.color_id', $color_id)
        ->where('option.size_id', $size_id)
        ->first();


    if ($item) {
        return $item->qty;
    } else {
        return 0;
    }
}

function get_subtotal($items)
{

    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal = $subtotal + ($item->price) * ($item->qty);
    }

    return $subtotal;
}

function get_subtotal_payment($items)
{
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal = $subtotal + $item->payment;
    }
    return $subtotal;
}

function get_totalpayments($items)
{

    $totalpayments = 0;
    foreach ($items as $item) {
        $totalpayments = $totalpayments + ($item->payment) * ($item->qty);
    }

    return $totalpayments;
}
