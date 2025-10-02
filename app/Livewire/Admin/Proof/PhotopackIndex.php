<?php

namespace App\Livewire\Admin\Proof;

use App\Models\Photopack;
use App\Models\Photoshot;
use App\Models\Store;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PhotopackIndex extends Component
{


    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search, $qrcode;
    public $sort = 'scheduled_at';
    public $direction = 'asc';
    public $registro;

    public $store_id = "";

    public $selecionado;

    public function mount()
    {
        // MASTER CLASS
        // Por default, Seleciona la tienda donde trabaja esta - PERSONBA AUTENTIFICADA
        $this->store_id = auth()->user()->store_id;
    }

    #[On('render-photopack-index')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        $photopacks = Photopack::where('store_id', $this->store_id)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(12);

        $stores = Store::all();

        return view('livewire.admin.proof.photopack-index', compact('photopacks', 'stores'));
    }

    public function select_photopack(){

        dd('Queso');

    }
}
