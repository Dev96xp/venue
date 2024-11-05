<?php

namespace App\Livewire\Footers;

use App\Models\Business;
use Livewire\Component;

class Footer extends Component
{
    public $business;

    public function render()
    {

        $this->business = Business::first();  //Todos los datos referente a este website

        return view('livewire.footers.footer');
    }
}
