<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Part;
use App\Models\Section;
use Livewire\Component;
use Livewire\Attributes\On;

class PartsIndex extends Component
{

    public $section;
    public $sort = 'order_position';
    public $direction = 'asc';   //desc and asc

    public function mount(Section $section)
    {
        $this->section = $section;
    }

    #[On('render-lista')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        //$section = $this->section;

        $parts = Part::where('section_id', $this->section->id)
        ->orderBy($this->sort, $this->direction)            // Livewire Sortable - Parte 4/5
        ->get();

        //dd($parts);

        return view('livewire.admin.sections.parts-index',compact('parts'));
    }


    public function updatePartsOrder($list){                 // Livewire Sortable - Parte 5/5

        //dd($list); Para hacer pruebas

        foreach($list as $item){
            Part::find($item['value'])->update(['order_position' => $item['order']]);
        }

    }

    // Elimina UN SOLO COLOR, de la lista
    public function delete_part(Part $part)
    {
        // Borra un registro especifico, sin importar nada(relacion uno a muchos)
        //$part = Part::find($part_id);
        $part->delete();

        // MASTER CLASS - REFRESCA al cmponente por tanto la vista tambien.
        $this->section = $this->section->fresh();
    }
}
