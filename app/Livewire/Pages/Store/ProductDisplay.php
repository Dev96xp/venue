<?php

namespace App\Livewire\Pages\Store;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class ProductDisplay extends Component
{
    public $products;

    public $product;
    public $quantity;
    public $qty = 1;


    // Esta variable ( $options ), es una arreglo de otras variables, para uso exclusivo
    // del carrito de compras
    public $options = [
        'description' => 'esto solo es una prueba',
        'sku' => '',
    ];


    // Muesta solo los producto que tienen el status=3, que siginifica
    // que fueron marcados para ser puestos en linea(publicados) y de estos solo se mostran 12
    // los ultimos agregados
    public function mount(){
        $this->products = Product::where('status_product_id',3)->latest('id')->get()->take(12);
    }


    public function render()
    {
        return view('livewire.pages.store.product-display');
    }

    // Agrega un producto al carrito de compras
    public function addItem($product_id)
    {

        //dd($product_id);


        $this->product = Product::find($product_id);
        $this->options['image'] = Storage::url($this->product->images->first()->url);
        $this->options['sku'] = $this->product->sku;
        //dd($this->product);


        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => 1,
            'price' => $this->product->price,
            'options' => $this->options,
        ]);

        // Actualizar el dropdown-cart
        $this->dispatch('render-dropdown-cart');

    }
}
