<?php

namespace App\Livewire\Admin\Product;

use App\Models\Image;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class DisplayProductImages extends Component
{
    public $product;
    public $image_url_selected;


    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.admin.product.display-product-images', $this->product);
    }

    // Esta a la escucha de un evento, en este caso viene de DisplaySectionImages
    // liviwire componente
    #[On('refresh-section')]
    public function refreshSection()
    {
        $this->product = $this->product->fresh();
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

        $this->product = $this->product->fresh();

        $this->dispatch('render-list-images');
    }

    public function select_image(Image $image)
    {
        $this->image_url_selected = $image->url;
    }
}

