<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class DropdownCart extends Component
{
    #[On('render-dropdown-cart')]
    public function render()
    {
        return view('livewire.dropdown-cart');
    }
}
