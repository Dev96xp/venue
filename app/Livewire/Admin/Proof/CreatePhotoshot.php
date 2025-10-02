<?php

namespace App\Livewire\Admin\Proof;

use App\Models\Photoshot;
use Livewire\Component;
use Livewire\Attributes\On;

class CreatePhotoshot extends Component
{
    public $open = false;
    public $name, $phone, $code, $status, $scheduled_at;
    public $photoshot, $photoshot_id = 0;




    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|max:30',
        'phone' => 'required',
        'code' => 'required|max:6|unique:photoshots,code',
        'status' => 'required',
        'scheduled_at' => 'required|date',
    ];

    public function mount() {}

    public function render()
    {
        return view('livewire.admin.proof.create-photoshot');
    }

    /*
    #[On('send-user')] //ESCUCHADOR DE EVENTO
    public function getUser(Photoshot $photoshot)
    {
        $this->photoshot = $photoshot;
        $this->photoshot_id = $photoshot->id;

        //dd($this->page);
    }
*/

    public function create_photoshot()
    {

        $this->validate();

        // DD($this->photoshot);


        // 2. Crea un nuevo photoshot
        $photoshot = Photoshot::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'code' => $this->code,
            'status' => 'ACTIVE',
            'cus_id' => 1,
            'scheduled_at' => $this->scheduled_at,
            'store_id' => auth()->user()->store_id,
            'user_id' => auth()->user()->id,
        ]);

        // 3. Reset Variable - Una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'name', 'phone', 'code', 'status']);

        // 4. En este caso para actualizar la lista de productos
        $this->dispatch('render-photoshot-index');
    }
}
