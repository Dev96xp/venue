<?php

namespace App\Livewire\Admin\Page;

use App\Models\Page;
use App\Models\Sectionx;
use Livewire\Component;
use Livewire\Attributes\On;

class CreateSection extends Component
{
    public $open = false;
    public $name, $note;
    public $page_id;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|max:30',
        'note' => 'required',
    ];

    public function mount(Page $page){
        $this->page_id = $page->id;
    }

    public function render()
    {
        return view('livewire.admin.page.create-section');
    }

    #[On('send-page')] //ESCUCHADOR DE EVENTO
    public function getPage(Page $page)
    {

        $this->page_id = $page->id;

        //dd($this->page);
    }

    public function create_section()
    {
        // 1. Validar los datos
        $this->validate();

        // 2. Crea un nueva page
        $page = Sectionx::create([
            'name' => $this->name,
            'note' => $this->note,
            'status' => 'Active',
            'page_id' => $this->page_id,
        ]);

        // 3. Reset Variable - Una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'name', 'note']);

        // 4. En este caso para actualizar la lista de productos
        $this->dispatch('render-list');
    }
}
