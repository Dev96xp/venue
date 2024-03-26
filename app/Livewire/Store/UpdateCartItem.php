<?php

namespace App\Livewire\Store;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class UpdateCartItem extends Component

// Este componente solo ACTUALIZA LA CANTIDAD en el Shopping Cart
{

    public $rowId, $qty;

    public function mount()
    {
        $item = Cart::get($this->rowId);
        $this->qty = $item->qty;
    }


    public function decrement()
    {
        $this->qty = $this->qty - 1;
        Cart::update($this->rowId, $this->qty);
        // Actualizar el dropdown-cart
        //$this->dispatch('update-dropdown-cart');
        $this->dispatch('render');
        $this->dispatch('render-dropdown-cart');
    }


    public function increment()
    {
        $this->qty = $this->qty + 1;
        Cart::update($this->rowId, $this->qty);
        // Actualizar el dropdown-cart
        //$this->dispatch('update-dropdown-cart',);
        $this->dispatch('render');
        $this->dispatch('render-dropdown-cart');
    }

    #[On('render')]
    public function render()
    {
        return view('livewire.store.update-cart-item');
    }
}
