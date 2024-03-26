<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Part;
use App\Models\Section;
use Livewire\Component;

class AddPart extends Component
{
    public $open = false;
    public $name, $description;
    public $section;

    public function mount(Section $section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.admin.sections.add-part');
    }

    public function save()
    {
        $this->section->parts()->create([
            'name' => $this->name,
            'description' => $this->description,
            'url' => '456'
        ]);

        $this->reset(['open','name','description']);

        // DISPATCH - Emite un evento, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-lista');

    }

}
