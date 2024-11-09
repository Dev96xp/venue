<?php

namespace App\Livewire\Admin\Proof;

use App\Models\Gallery;
use App\Models\Image;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class GalleryIndex extends Component
{

    public $galleries;
    public $galleria_selecionada;
    public $user;
    public $user_id;


    public function mount()
    {
        $this->user = User::first();
        //$this->user = User::find(2);
        $this->galleries = $this->user->galleries;
    }

    #[On('render-gallery-list')] //ESCUCHADOR DE EVENTO
    public function render()
    {
        $this->galleries = $this->user->galleries;
        return view('livewire.admin.proof.gallery-index');
    }

    #[On('send-user')] //ESCUCHADOR DE EVENTO
    public function getUser(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
    }


    // NUEVO 2024
    // 5. Se esta ala eschucha del enevento: 'delete_gallery' que viene de SweetAlert2 en javascript
    // 6. Y se recibe tambien la variable que biene con sigo: $gallery
    #[On('delete_gallery')]
    public function delete_gallery(Gallery $gallery)
    {

        $images = $gallery->images;   //tal vez otra manera
        //dd($images);


        foreach ($images as $image) {
            // Aqui borro las imagenes atravez de la carpeta PUBLIC
            $url = 'public/' . $image->url;
            //dd([$url]);
            // MASTER CLASS - Aqui se remplaza la palabra (storage por public) para poder eliminar las imagenes
            //$url = str_replace('storage','public',$image->url);


            //Storage::delete([$image->url]);
            Storage::delete([$url]);          // Borra el archivo fisicamente
            $image->delete();               // Borra el registro de la base de datos
        }

        $gallery->delete();

        //$this->gallery = $this->gallery->fresh();
    }

    public function select_gallery(Gallery $gallery)
    {

        $this->galleria_selecionada = $gallery->name;

        $this->dispatch('send-gallery', gallery: $gallery);  // ENVIO EL PAQUETE SELECIONADO POR EL USUARIO
        //$this->dispatch('post-created', title: $post->title);  ESTE ES SOLO UN EJEMPLO

    }

    public function update_status($gallery_id)
    {

        $gallery = Gallery::find($gallery_id);

        //dd($product->status_product->id);

        switch ($gallery->status) {
                // Si es ACTIVE lo cambio a VIEW
            case 'ACTIVE':
                $gallery->status = 'VIEW';
                $gallery->save();
                break;
            case 'VIEW':
                // Si es VIEW lo cambio a HIDE
                $gallery->status = 'HIDE';
                $gallery->save();
                break;
            case 'HIDE':
                // Si es HIDE lo cambio a ACTIVE
                $gallery->status = 'ACTIVE';
                $gallery->save();
                break;
            default:
                # code...
                break;
        }

        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        //$this->$items_venue = $this->$items_venue->fresh();
    }

}
