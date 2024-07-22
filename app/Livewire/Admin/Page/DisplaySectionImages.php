<?php

namespace App\Livewire\Admin\Page;

use App\Models\Image;
use App\Models\Sectionx;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class DisplaySectionImages extends Component
{
    public $sectionx;
    public $image_url_selected;


    public function mount(Sectionx $sectionx)
    {
        $this->sectionx = $sectionx;
    }

    public function render()
    {
        return view('livewire.admin.page.display-section-images', $this->sectionx);
    }

    // Esta a la escucha de un evento, en este caso viene de DisplaySectionImages
    // liviwire componente
    #[On('refresh-section')]
    public function refreshSection()
    {
        $this->sectionx = $this->sectionx->fresh();
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

        $this->sectionx = $this->sectionx->fresh();

        $this->dispatch('render-list-images');
    }

    public function select_image(Image $image)
    {
        $this->image_url_selected = $image->url;
    }
}

