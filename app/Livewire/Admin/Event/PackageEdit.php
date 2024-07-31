<?php

namespace App\Livewire\Admin\Event;

use App\Models\Package;
use Livewire\Component;

class PackageEdit extends Component
{

    public $package_id;    // ($event_id, es el evento selecionado, esta variable viene
                         // desde el componente[EventsIndex] y esta sincronizada)

    public $open = false;
    public $package, $type = 5;

    public $packageEditId;


    // 1.  Crear una propiedad que tenga los mismos campos del formulario
    public $packageEdit = [
        'code' => 'required',
        'name' => 'required',
        'status' => 'required',
    ];

    public function mount(Package $package){

        $this->package = $package;
        $this->package_id = $package->id;
        $this->packageEditId = $this->package->id;

        $package = Package::find($this->package->id);
        $this->packageEditId = $this->package->id;


        // Muesta estos valores en el formulario
        $this->packageEdit['code'] = $package->code;
        $this->packageEdit['name'] = $package->name;
        $this->packageEdit['status'] = $package->status;
    }

    public function render()
    {
        $this->package = Package::find($this->package->id);
        $this->packageEditId = $this->package->id;

        // Muesta estos valores en el formulario
        $this->packageEdit['code'] = $this->package->code;
        $this->packageEdit['name'] = $this->package->name;
        $this->packageEdit['status'] = $this->package->status;

        return view('livewire.admin.event.package-edit');
    }

    // MASTER CLASS - Actualiza la fecha
    // a) Llamamos a la propiedad: image
    // b) Le pasamos el metodo: save
    // c) Esto va ser que cualquier cambio que hallamos hecho
    // en la propiedad : image, se actualice en la base de datos

    public function save(){

        $package = Package::find($this->packageEditId);

        $package->update([
            'code' => $this->packageEdit['code'],
            'name' => $this->packageEdit['name'],
        ]);

        $this->reset(['open','packageEdit','packageEditId']);

        // DISPATCH - Emite un imageo, para ser escuchado por otro componente de livewire
        // EJEMPLO - $this->dispatch('post-created', title: $post->title);
        // En este caso para actusalizar la lista de partes
        $this->dispatch('render-configuration');

    }

    public function hide(){

        // NO SE ESTA USANDO

        $this->package->status ='HIDE';
        $this->package->save();  //Guardar los cambios
        $this->reset(['open']); //Reset la variable open, para cerra el formulario(Modal)

        $this->dispatch('render-images');
    }

}
