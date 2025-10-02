<?php

namespace App\Livewire\Admin\User;

use App\Models\Store;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditUser extends Component
{
    public $open = false;
    public $botton_type = 'edit';
    public $user;
    public $user_id;
    public $stores;

    // MASTER CLASS
    // 1. Definimos las reglas de validacion para los campos del formulario
    // Se utiliza la propiedad Validate para definir las reglas de validacion

    #[Validate('required|max:60')]
    public $name;
    #[Validate('required|max:12')]
    public $phone;
    #[Validate('required|max:50')]
    public $address;
    #[Validate('required|max:40')]
    public $city;
    #[Validate('required|max:5')]
    public $zip;
    #[Validate('required|max:2')]
    public $state;
    // Se define la validacion para el email, se puede agregar unique, si se desea validar que no se repita
    #[Validate('required|')]
    public $email;
    // Se define la tienda a la que pertenece el usuario
    #[Validate('required|')]
    public $store_id;



    public function mount(User $user){

        $this->user = $user;
        $this->user_id = $this->user->id;
        $user = User::find($this->user->id);

        // 2. Inicializamos las variables
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->city = $user->city;
        $this->zip = $user->zip;
        $this->state = $user->state;
        $this->email = $user->email;
        $this->store_id = $user->store_id;

        $this->stores = Store::all();

    }

    public function render()
    {
        return view('livewire.admin.user.edit-user');
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
        $this->user->store_id= $this->store_id;

        $this->user->update();  //Guardar los cambios
        //$this->emit('render');

        $this->reset(['open']); //Reset la variable open, para cerra el formulario(Modal)

        //$this->emit('alert', 'La orden se actualizo satisfactoriamente');
        $this->dispatch('render-user-index');

    }
}
