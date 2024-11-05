<?php

namespace App\Livewire\Admin\Proof;

use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UsersIndex extends Component
{

    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search, $qrcode;
    public $sort = 'created_at';
    public $direction = 'desc';

    public $store_id = "";

    public $selecionado;

    public function mount()
    {
        // MASTER CLASS
        // Por default, Seleciona la tienda donde trabaja esta - PERSONBA AUTENTIFICADA
        $this->store_id = auth()->user()->store_id;
    }


    public function render()
    {
        $users = User::where('store_id', $this->store_id)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(10);

        $stores = Store::all();

        return view('livewire.admin.proof.users-index', compact('users', 'stores'));
    }


    public function limpiar_page()
    {
        $this->resetPage();
    }

    public function findCustomer()
    {

        $user = User::where('cus_id', '=', $this->qrcode)->first();

        //dd($user);
        if ($user) {
            return redirect()->route('admin.pos.index', compact('user'))->with('info', 'Se agrego un elemnto con exito');
        } else {
            #No hacer nada
        }
    }

    public function select_user(User $user)
    {

        $this->selecionado = $user->name;

        $this->dispatch('send-user', user: $user);  // ENVIO EL PAQUETE SELECIONADO POR EL USUARIO
        //$this->dispatch('post-created', title: $post->title);  ESTE ES SOLO UN EJEMPLO

    }
}
