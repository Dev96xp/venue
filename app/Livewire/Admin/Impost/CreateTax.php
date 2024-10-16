<?php

namespace App\Livewire\Admin\Impost;

use App\Models\Tax;
use Livewire\Component;

class CreateTax extends Component
{
    public $open = false;
    public $name, $tax;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|max:30',
        'tax' => 'required'
    ];

    public function render()
    {
        return view('livewire.admin.impost.create-tax');
    }

    public function create_page()
    {
        // 1. Validar los datos
        $this->validate();

        // 2. Crea un nueva page
        $tax = Tax::create([
            'name' => $this->name,
            'tax' => $this->tax,
        ]);

        // 3. Reset Variable - Una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'name', 'tax']);

        // 4. En este caso para actualizar la lista de taxes
        $this->dispatch('render-tax-list');
    }
}
