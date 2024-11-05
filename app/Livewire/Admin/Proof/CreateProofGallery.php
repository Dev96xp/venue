<?php

namespace App\Livewire\Admin\Proof;

use App\Models\Gallery;
use App\Models\Page;
use App\Models\Sectionx;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class CreateProofGallery extends Component
{
    public $open = false;
    public $name, $code, $status;
    public $user, $user_id = 0;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|max:30',
        'code' => 'required|unique:galleries,code|max:6',
        'status' => 'required'
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
    }

    public function render()
    {
        return view('livewire.admin.proof.create-proof-gallery');
    }

    #[On('send-user')] //ESCUCHADOR DE EVENTO
    public function getUser(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;

        //dd($this->page);
    }

    public function create_gallery()
    {

        $this->validate();

        //DD($this->user);

        if ($this->user->id <> 0) {
            // 2. Crea un nueva gallery para proofing
            $gallery = Gallery::create([
                'name' => $this->name,
                'code' => $this->code,
                'status' => $this->status,
                'user_id' => $this->user_id,
            ]);

            // 3. Reset Variable - Una vez usadas la porpiedades, limpia las propiedades (reset)
            //    y cierra el MODAL tambien
            $this->reset(['open', 'name', 'code', 'status']);

            // 4. En este caso para actualizar la lista de productos
            $this->dispatch('render-gallery-list');
        } else {

        }
    }
}
