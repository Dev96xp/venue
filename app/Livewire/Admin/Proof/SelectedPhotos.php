<?php

namespace App\Livewire\Admin\Proof;

use App\Livewire\Admin\Product\ImagesProductList;
use App\Models\Gallery;
use App\Models\Image;
use Livewire\Component;

use Livewire\WithPagination;
use Livewire\Attributes\On;

class SelectedPhotos extends Component
{


    public $gallery;
    public $gallery_id;
    public $imagen_selecionada;

    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function mount()
    {

        // Por default apuntar a la primer galleria
        $this->gallery = Gallery::first();
        $this->gallery_id = $this->gallery->id;


        // $this->images = Image::where('imageable_type', 'App\Models\Gallery')
        // ->where('imageable_id', 2)
        // ->paginate(4);
    }

    public function render()
    {
        // $gallery = Gallery::find($this->gallery->id);

        // $this->images = $gallery->images;

        $images = Image::where('imageable_type', 'App\Models\Gallery')
            ->where('imageable_id', $this->gallery_id)
            ->where('status', 2)    // Significa que el usuario seleciono esta imagen para revelar
            ->get();

        return view('livewire.admin.proof.selected-photos', compact('images'));
    }

    #[On('send-gallery')] //ESCUCHADOR DE EVENTO
    public function getGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->gallery_id = $gallery->id;
    }

    public function limpiar_page()
    {
        $this->resetPage();
    }
}

