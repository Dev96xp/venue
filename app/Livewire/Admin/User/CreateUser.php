<?php

namespace App\Livewire\Admin\User;

use App\Models\Account;
use App\Models\Ids;
use App\Models\Store;
use App\Models\User;
use Livewire\Component;

class CreateUser extends Component
{
    public $open = false;
    public $name, $phone, $company, $address, $city, $state, $zip, $email, $store_id = "";
    public $user;
    public $stores;

    // MASTER CLASS
    // SUPER IMPORTATNTE ESTAS REGLAS DE VALIDACION,
    // PARA QUE LOS VALORES APARESCAN EN EL FORMULARIO
    // ESTO ME PERMITIRA USAR LAS PROPIEDADES DEL OBJETO EN EL FORMULARIO
    protected $rules = [
        'name' => 'required|max:100',
        'phone' => 'required|max:12',
        'address' => 'required',
        'city' => 'required|max:20',
        'state' => 'required|max:2',
        'zip' => 'required|max:5',
        'email' => 'required|email|unique:users,email',  //.......WOOOOW !!!! TRABAJA MUY BIEN
        'store_id' => 'required'
    ];

    public function mount()
    {
        $this->stores = Store::all();
    }

    public function render()
    {
        return view('livewire.admin.user.create-user');
    }

    public function save()
    {
        // Validar los datos
        $this->validate();

        // 1. Genra un email y password usnado el telefono
        $pass = $this->phone;

        // 2. Obtiene el nuevo ID de la tabla: ids, para el NUEVO usuario en la tabla: USERS (CLIENTE)
        $new_user_id = Ids::find(1); // Next id para: [users]

        $user = User::create([
            'name' => $this->name,                  // Nombre del usuario del formulario
            'cus_id' => date('Y') . '-' . $new_user_id->nextid,    // Se genera nuevo id del usuario
            'phone' => $this->phone,                // Telefono del formulario
            'company' => $this->company,            // Date del formulario
            'address' => $this->address,            // Date del formulario
            'city' => $this->city,                  // Description del formulario
            'state' => $this->state,
            'zip' => $this->zip,
            'email' => $this->email,
            'store_id' => $this->store_id,
            'password' => bcrypt($pass)             // Password creado usando el numero telefonico
            //'executive_id' => auth()->user()->id, // Ejecutivo de ventas
        ]);

        // 3. Asignar role
        $user->assignRole('Customer');

        // 4. Crear una Cuenta Nueva para el cliente
        $new_acc_id = Ids::find(4); // Next id para: [Account]
        $new_account_Id = date('Y') . '-' . date('m') . date('d') . '-' . $new_acc_id->nextid;
        // OJO - importante declarar una cada variable como [ fillable] en el modelo Account
        //       de lo contrario los valores no seran guardados
        $account = Account::create([
            'name' => 'checking',
            'acc_id' => $new_account_Id,
            'user_id' => $user->id
        ]);

        // 5. Una vez usadas la porpiedades, limpia las propiedades (reset)
        //    y cierra el MODAL tambien
        $this->reset(['open', 'name', 'phone', 'company', 'address', 'city', 'state', 'zip', 'email', 'store_id']);

        // 6. En este caso para actualizar la lista de usuarios
        $this->dispatch('render-user-index');
    }
}
