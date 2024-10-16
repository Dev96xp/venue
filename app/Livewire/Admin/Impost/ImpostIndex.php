<?php

namespace App\Livewire\Admin\Impost;

use App\Models\Impost;
use Livewire\Component;
use Livewire\Attributes\On;

class ImpostIndex extends Component
{

    public $imposts, $impost, $taxes;

    public function mount(){
        $this->imposts = Impost::all();

        //dd($this->impost->taxes);
    }

    #[On('render-list-impost')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        $this->imposts = Impost::all();
        //dd($taxes);
        return view('livewire.admin.impost.impost-index');
    }

    public function edit_impost(){

    }

    public function select_impost(Impost $impost){
        $this->impost = $impost;    // Actulizacion de la variable
    }

    public function del_impost(Impost $impost){
        $impost->delete();
    }
}
