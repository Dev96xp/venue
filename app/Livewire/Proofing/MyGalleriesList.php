<?php

namespace App\Livewire\Proofing;

use App\Models\Gallery;
use App\Models\User;
use Livewire\Component;

class MyGalleriesList extends Component
{
    public $user;
    public $selecionado;

    public function mount(User $user){
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.proofing.my-galleries-list');
    }

    public function select_gallery(Gallery $gallery)
    {

        $this->selecionado = $gallery->name;

        $this->dispatch('send-gallery', gallery: $gallery);  // ENVIO EL PAQUETE SELECIONADO POR EL USUARIO
        //$this->dispatch('post-created', title: $post->title);  ESTE ES SOLO UN EJEMPLO

    }

}
