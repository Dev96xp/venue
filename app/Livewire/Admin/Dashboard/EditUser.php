<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\User;
use App\Models\Store;
use Livewire\Component;

class EditUser extends Component
{
    public $open = false;
    public $user;
    public $botton_type = 'edit';

    public $name, $phone, $address, $city, $zip, $state, $email, $store_id;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|max:100',
        'phone' => 'required|max:12',
        'address' => 'required',
        'city' => 'required|max:20',
        'zip' => 'required|max:5',
        'state' => 'required|max:2',
        'email' => 'required',
        'store_id' => 'required'
    ];


    public function mount(User $user){
        $this->user = $user;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->city = $user->city;
        $this->zip = $user->zip;
        $this->state = $user->state;
        $this->email = $user->email;
        $this->store_id = $user->store_id;
    }


    public function render()
    {
        $stores = Store::all();
        return view('livewire.admin.dashboard.edit-user',compact('stores'));
    }


    // MASTER CLASS
    // a) Llamamos a la propiedad tuxedo
    // b) Le pasamos el metodo save
    // c) Esto va ser que cualquier cambio que hallamos hecho
    // en la propiedad tuxedo, se actualice en la base de datos

    public function update(){

        $this->validate();  //Validar los valores

        $this->user->name = $this->name;
        $this->user->phone = $this->phone;
        $this->user->address = $this->address;
        $this->user->city = $this->city;
        $this->user->zip = $this->zip;
        $this->user->state = $this->state;
        $this->user->email = $this->email;
        $this->user->store_id = $this->store_id;

        $this->user->save();  //Guardar los cambios

        $this->reset(['open']); //Reset la variable open, para cerra el formulario(Modal)

    }
}

