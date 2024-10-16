<?php

namespace App\Livewire\Admin\Impost;

use App\Models\Tax;
use Livewire\Component;
use Livewire\Attributes\On;

class TaxIndex extends Component

{
    public $taxes;

    public function mount(){
        $this->taxes = Tax::all();
    }


    #[On('render-tax-list')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        return view('livewire.admin.impost.tax-index');
    }


    public function edit_impost(){

    }

    public function delete_tax(Tax $tax){
        $tax->delete();
        $this->taxes = $this->taxes->fresh();

        $this->dispatch('render-list-impost');
    }
}
