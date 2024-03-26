<?php

namespace App\Livewire\Price;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class PriceInvite extends Component
{
    public $product;
    public $quantity;
    public $qty = 1;


    // Esta variable ( $options ), es una arreglo de otras variables, para uso exclusivo
    // del carrito de compras
    public $options = [
        'description' => 'esto solo es iuna prueba',
        'sku' => '',
    ];


    public function mount()
    {
        $this->product = Product::find(1);

        //dd($this->product);
        if (isset($this->product->images->first()->url)) {
            $this->options['image'] = Storage::url($this->product->images->first()->url);
        } else {
            $this->options['image'] = "";
        }

        //dd($this->product->images->first()->url);
        //$this->options['image'] = Storage::url($this->product->images->first()->url);
    }


    public function render()
    {
        return view('livewire.price.price-invite');
    }

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
