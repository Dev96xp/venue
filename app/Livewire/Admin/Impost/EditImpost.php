<?php

namespace App\Livewire\Admin\Impost;

use App\Models\Impost;
use App\Models\Tax;
use Database\Seeders\TaxSeeder;
use Livewire\Component;

class EditImpost extends Component
{

    public $impost_id;

    public $open = false;
    public $impost, $taxs;


    public $impostEditId;


    // 1.  Crear una propiedad que tenga los mismos campos del formulario
    public $impostEdit = [
        'name' => 'required',
    ];

    public function mount(Impost $impost)
    {

        $this->impost = $impost;
        $this->impost_id = $impost->id;
        $this->impostEditId = $this->impost->id;

        $impost = Impost::find($this->impost->id);
        $this->impostEditId = $this->impost->id;

        $this->taxs = Tax::all();

        // Muesta estos valores en el formulario
        $this->impostEdit['name'] = $impost->name;
    }

    public function render()
    {
        $this->impost = impost::find($this->impost->id);
        $this->impostEditId = $this->impost->id;

        // Muesta estos valores en el formulario
        $this->impostEdit['name'] = $this->impost->name;

        return view('livewire.admin.impost.edit-impost');
    }

    // MASTER CLASS - Actualiza la fecha
    // a) Llamamos a la propiedad: impost
    // b) Le pasamos el metodo: save
    // c) Esto va ser que cualquier cambio que hallamos hecho
    // en la propiedad : impost, se actualice en la base de datos

    public function save()
    {

        $impost = impost::find($this->impostEditId);

        $impost->update([
            'name' => $this->impostEdit['name'],
        ]);

        $this->reset(['open', 'impostEdit', 'impostEditId']);

        $this->dispatch('render-list-impost');
    }


    // Agrega un size a un grupo especifico de tallas
    public function add_tax($tax_id)
    {
        // Agregar regla de validacion
        $this->validate([
            'impost_id' => 'required'
        ]);

        $impost = Impost::find($this->impost_id);

        $impost->taxes()->attach([
            $tax_id
        ]);

        $this->dispatch('render-list-impost');

        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        //$this->product = $this->product->fresh();
    }


    public function del_tax($tax_id){

        $impost = Impost::find($this->impost_id);

        $impost->taxes()->detach([
            $tax_id
        ]);



        $this->dispatch('render-list-impost');
    }
}
