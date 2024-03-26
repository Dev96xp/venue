<?php

namespace App\Livewire\Admin\Sections;

use Livewire\Component;
use App\Models\Section;
use App\Models\Image;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class DisplayImages extends Component
{
    public $section;
    public $image_url_selected;


    public function mount(Section $section)
    {
        $this->section = $section;
    }

    public function render()
    {
        return view('livewire.admin.sections.display-images', $this->section);
    }

    // Esta a la escucha de un evento, en este caso viene de DisplayImages liviwire componente
    #[On('refresh-section')]
    public function refreshSection()
    {
        $this->section = $this->section->fresh();
    }


    public function deleteImages(Image $image)
    {
        // Aqui borro las imagenes atravez de la carpeta PUBLIC
        $url = 'public/' . $image->url;
        //dd([$url]);
        // MASTER CLASS - Aqui se remplaza la palabra (storage por public) para poder eliminar las imagenes
        //$url = str_replace('storage','public',$image->url);


        //Storage::delete([$image->url]);
        Storage::delete([$url]);          // Borra el archivo fisicamente
        $image->delete();               // Borra el registro de la base de datos

        $this->section = $this->section->fresh();
    }

    public function select_image(Image $image)
    {
        $this->image_url_selected = $image->url;
    }
}
