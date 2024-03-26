<?php

namespace App\Livewire\Store;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class ShoppingCart extends Component
{

    public function destroy()
    {
        Cart::destroy();
        // Actualizar el dropdown-cart
        $this->dispatch('render');
        $this->dispatch('render-dropdown-cart');
    }


    public function delete($rowId)
    {
        Cart::remove($rowId);
        // Actualizar el dropdown-cart
        $this->dispatch('render');
        $this->dispatch('render-dropdown-cart');
    }

    #[On('render')]
    public function render()
    {
        // return view('livewire.store.shopping-cart');  ORIGINAL - Por default se redizara en la plantilla (layouts.app.blade.php)
        // pero en su lugar se usara otra plantilla llamada: (layouts.store.blade.php)
        return view('livewire.store.shopping-cart')->layout('layouts.invitation');
    }
}
