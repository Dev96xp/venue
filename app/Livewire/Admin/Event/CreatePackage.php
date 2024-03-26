<?php

namespace App\Livewire\Admin\Event;

use App\Models\Package;
use Livewire\Component;

class CreatePackage extends Component
{
    public $open = false;
    public $botton_type = 'create';


    public $code, $name;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'code' => 'required|max:10|unique:elements',
        'name' => 'required',
    ];

    public function render()
    {
        return view('livewire.admin.event.create-package');
    }

    public function save()
    {

        // Validar los datos
        $this->validate();

        // Se Crea el nuevo registro en la tabla: PERMISSIONS
        $package = Package::create([
            'code' => $this->code,                                 // Nombre del permiso
            'name' => $this->name,
            'phone' => "402-000-0000",  // ESTE CAMPO SOLO EXISTE EN SERVIDOR, NO LOCAL
            'date' => today(),          // ESTE CAMPO SOLO EXISTE EN SERVIDOR, NO LOCAL
            'store_id' => 1,            // ESTE CAMPO SOLO EXISTE EN SERVIDOR, NO LOCAL
            'note' => "",
            'description' => "",
            'aux1' => "",
            'aux2' => "",
            'status' => "ACTIVE"
        ]);

        // b) una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'code','name']);

        // c) Emitir - un evento para avisa lo que se hizo, su objetivo de este evento
        //   es avisar q se agrego un nuevo post y por tanto RENDERIZAR LA VISTA DE OTRO COMPONENTE, PARA VER LOS CAMBIOS
        //   por tal motivo este evento lo llamare: render
      //xxx  $this->emit('render');
      //xxx  $this->emit('alert');

    }


}
