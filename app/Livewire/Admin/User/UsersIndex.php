<?php

namespace App\Livewire\Admin\User;

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

    public $lbCase = 3;  //En el caso 3, Imprimir etiqueta para usuarios
    public $lbCode = "";
    public $lbName = "";
    public $lbPhone = "";
    public $lbStore = "";

    public function mount()
    {
        // MASTER CLASS
        // Por default, Seleciona la tienda donde trabaja esta - PERSONBA AUTENTIFICADA
        $this->store_id = auth()->user()->store_id;
    }

    #[On('render-user-index')]
    public function render()
    {

        //   $users = User::where('store_id', $this->store_id)
        //   ->where('name','LIKE', '%' . $this->search .'%')
        //   ->where('cus_id','LIKE', '%' . $this->qrcode .'%')
        //   ->orderBy($this->sort, $this->direction)
        //   ->paginate(20);

        $users = User::where('store_id', $this->store_id)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(5);

        $stores = Store::all();

        return view('livewire.admin.user.users-index', compact('users', 'stores'));
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

    public function select_user($user_id)
    {

        $user = User::find($user_id);

        $this->lbCase = 3;  //En el caso 1, Imprimir etiqueta para users;
        $this->lbCode = $user->id;
        $this->lbName = $user->name;
        $this->lbPhone = $user->phone;
        $this->lbStore = $user->store->name;
    }
}
