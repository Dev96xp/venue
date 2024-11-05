<?php

namespace App\Livewire\Proofing;

use App\Models\Gallery;
use App\Models\Image;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination; // Se manda llamar la paginacion

class MyProofingGalleries extends Component
{
    protected $paginationTheme = "bootstrap";
    // Ayuda para que la PAGINACION sea dinamica, osea se actualizan
    // los datos en pantalla, sin actualizar la pantalla completa.
    use WithPagination;

    public $gallery, $gallery_id;
    public $images;

    public $proofed_images = 0;
    public $total_images = 0;

    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }


    public function render()
    {

        // $this->proofed_images = Image::where('imageable_id', $this->gallery_id)   // a qui voy.......corregir aqui
        //     ->where('status', 2)
        //     ->get();

        $this->proofed_images = Image::where('imageable_type', 'App\Models\Gallery')   //Creo que ya funcionop muy bien
            ->where('imageable_id', $this->gallery_id)
            ->where('status', 2)
            ->get();

        //  $this->total_images = Image::where('imageable_id', $this->gallery_id)   // este ya no se usa

        // $this->images = Image::where('imageable_id', $this->gallery_id)
        //     ->get();

        //  $this->images = Image::where('imageable_type', 'App\Models\Gallery')   //aqui voy la mejor
        //      ->where('imageable_id', $this->gallery_id)
        //      ->get();

        $this->images = $this->gallery->images;  // Obtiene todas las imagenes, Si funciono, yeah !!!


        return view('livewire.proofing.my-proofing-galleries');
    }

    #[On('send-gallery')] //ESCUCHADOR DE EVENTO
    public function getGallery(Gallery $gallery)
    {
        $this->gallery = $gallery;
        $this->gallery_id = $gallery->id;
    }

    public function update_proof_status($image_id)
    {
        $image = Image::find($image_id);

        switch ($image->status) {
                // Si es 1 lo cambio a 2
            case '1':
                $image->status = 2;
                $image->save();
                break;
            case '2':
                // Si es 2 lo cambio a 1
                $image->status = 1;
                $image->save();
                break;

            default:
                # code...
                break;
        }
    }
}
