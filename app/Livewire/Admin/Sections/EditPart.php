<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Part;
use Livewire\Component;

class EditPart extends Component
{
    public $openx = false;

    public $part;               //Para datos de las bases de datos
    public $partsEdit = [       //Para datos a editar
        'name' => '',
        'description' => '',
    ];

    protected $rules = [
        'partsEdit.name' => 'required|max:40',
        'partsEdit.description' => 'required|max:100'
    ];


    public function mount(Part $part)
    {
        $this->part = $part;
    }

    public function render()
    {
        $part = Part::find($this->part->id);

        $this->partsEdit['name'] = $part->name;
        $this->partsEdit['description'] = $part->description;

        return view('livewire.admin.sections.edit-part');
    }


    public function update()
    {
        // Validar los datos
        $this->validate();

        $this->part->name = $this->partsEdit['name'];
        $this->part->description = $this->partsEdit['description'];
        $this->part->save();

        $this->reset(['openx']);

        // DISPATCH - Emite un evento, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-lista');

    }



}

