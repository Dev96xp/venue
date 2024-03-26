<?php

namespace App\Livewire\Admin\Event;

use App\Models\Element;
use App\Models\Package;
use Livewire\Component;
use Livewire\Attributes\On;

class AddElement extends Component
{

    // Ayuda para que la PAGINACION sea dinamica, osea se actualizan
    // los datos en pantalla, sin actualizar la pantalla completa.
    //use WithPagination;

    public $open = false;
    public $botton_type = 'nada';

    public $element;
    public $package;


     public function mount(Element $element)
     {
         $this->element = $element;
     }

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|unique:elements'
    ];

    public function render()
    {
        $elements = Element::all();
        return view('livewire.admin.event.add-element', compact('elements'));
    }

    // LISTENERS
    // b) Me ejecuto solo y cuando el LISTENERS, me ha escuchado, que fui enviado por
    //    otro componente, y traigo conmigo datos llamdos: ( $rental ) (Inf. de la actual renta)
    // c) Con ello actualizo la misma variable para este componente

    #[On('send-data')] //ESCUCHADOR DE EVENTO
    public function sendData(Package $package)
    {
        $this->package = $package;
        $this->botton_type = 'nada';

    }


    // Agrega un color al producto
    public function add_element(Element $element)
    {

        $this->package->elements()->attach($element->id);
        //$package->elements()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]);



        // MASTER CLASS - REFRESCA al componente por tanto la vista tambien.
        $this->package = $this->package->fresh();

        // $this->emit('render');  ANTES
        $this->dispatch('render-configuration');  //NEW

        $this->reset(['open']);
    }


}
