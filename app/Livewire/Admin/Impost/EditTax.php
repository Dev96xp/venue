<?php

namespace App\Livewire\Admin\Impost;

use App\Models\Tax;
use Livewire\Component;

class EditTax extends Component
{

    public $open = false;
    public $tax;

    public $taxEditId;


    // 1.  Crear una propiedad que tenga los mismos campos del formulario
    public $taxEdit = [
        'name' => 'required',
        'tax' => 'required'
    ];

    public function mount(Tax $tax){

        $this->tax = $tax;
        $this->taxEditId = $this->tax->id;

        $tax = tax::find($this->tax->id);
        $this->taxEditId = $this->tax->id;


        // Muesta estos valores en el formulario
        $this->taxEdit['name'] = $tax->name;
        $this->taxEdit['tax'] = $tax->tax;
    }

    public function render()
    {
        $this->tax = tax::find($this->tax->id);
        $this->taxEditId = $this->tax->id;

        // Muesta estos valores en el formulario
        $this->taxEdit['name'] = $this->tax->name;

        return view('livewire.admin.impost.edit-tax');
    }

    // MASTER CLASS - Actualiza la fecha
    // a) Llamamos a la propiedad: tax
    // b) Le pasamos el metodo: save
    // c) Esto va ser que cualquier cambio que hallamos hecho
    // en la propiedad : tax, se actualice en la base de datos

    public function save(){

        $tax = tax::find($this->taxEditId);

        $tax->update([
            'name' => $this->taxEdit['name'],
            'tax' => $this->taxEdit['tax'],
        ]);

        $this->reset(['open','taxEdit','taxEditId']);

        // DISPATCH - Emite un mensaje, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-tax-list');
    }

    public function delete_impost(){

    }

}
