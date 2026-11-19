<?php

namespace App\Livewire\Admin\User;

use App\Models\Store;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

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

        $users = self::withDeletionInfo(User::query())
            ->where('store_id', $this->store_id)
            ->where('name', 'LIKE', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction)
            ->paginate(16);

        $stores = Store::all();

        return view('livewire.admin.user.users-index', compact('users', 'stores'));
    }

    // ---------------------------------------------------------------
    // BORRAR CLIENTES "BASURA" CON UN CLIC
    // Solo se pueden borrar clientes vacíos: sin eventos, contratos,
    // ventas, fotos, etc., y que no sean administradores/empleados.
    // ---------------------------------------------------------------

    // Tablas con datos importantes del cliente => nombre para mostrar
    const PROTECTED_DATA = [
        'events' => 'eventos',
        'contracts' => 'contratos',
        'orders' => 'órdenes',
        'galleries' => 'galerías',
        'photopacks' => 'paquetes de fotos',
        'photoshots' => 'fotos',
        'invitations' => 'invitaciones',
        'posts' => 'posts',
        'files' => 'archivos',
    ];

    public array $selected = [];   // Para borrar varios a la vez

    /**
     * Agrega al query los conteos que deciden si un cliente se puede borrar.
     */
    public static function withDeletionInfo($query)
    {
        $query->select('users.*');

        foreach (array_keys(self::PROTECTED_DATA) as $table) {
            $query->selectSub(
                DB::table($table)->selectRaw('count(*)')->whereColumn("{$table}.user_id", 'users.id'),
                "{$table}_total"
            );
        }

        // Ventas del POS (cuelgan de la cuenta que se crea automáticamente con cada cliente)
        $query->selectSub(
            DB::table('transactions')->join('accounts', 'accounts.id', '=', 'transactions.account_id')
                ->selectRaw('count(*)')->whereColumn('accounts.user_id', 'users.id'),
            'transactions_total'
        );

        // Roles distintos a Customer (Admin, empleados...)
        $query->selectSub(
            DB::table('model_has_roles')->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
                ->selectRaw('count(*)')
                ->where('model_has_roles.model_type', User::class)
                ->whereColumn('model_has_roles.model_id', 'users.id')
                ->where('roles.name', '!=', 'Customer'),
            'staff_roles_total'
        );

        return $query;
    }

    /**
     * Motivos por los que NO se puede borrar (vacío = se puede borrar).
     */
    public static function deletionBlockers(User $user): array
    {
        $reasons = [];

        if ($user->id === auth()->id()) {
            $reasons[] = 'es tu propio usuario';
        }
        if ($user->staff_roles_total > 0) {
            $reasons[] = 'es administrador/empleado';
        }
        foreach (self::PROTECTED_DATA as $table => $label) {
            if ($user->{"{$table}_total"} > 0) {
                $reasons[] = $user->{"{$table}_total"} . ' ' . $label;
            }
        }
        if ($user->transactions_total > 0) {
            $reasons[] = $user->transactions_total . ' ventas';
        }

        return $reasons;
    }

    // Borra un cliente con un clic (si está vacío)
    public function deleteUser($userId)
    {
        $this->deleteUsers([$userId]);
    }

    // Borra los clientes seleccionados (solo los vacíos)
    public function deleteSelected()
    {
        $this->deleteUsers($this->selected);
        $this->selected = [];
    }

    protected function deleteUsers(array $ids)
    {
        abort_unless(auth()->user()->can('User edit'), 403);

        $users = self::withDeletionInfo(User::query())->whereIn('users.id', $ids)->get();
        $deleted = [];
        $skipped = [];

        foreach ($users as $user) {
            // Se vuelve a revisar en el servidor justo antes de borrar
            if (self::deletionBlockers($user)) {
                $skipped[] = $user->name;
                continue;
            }

            try {
                DB::transaction(function () use ($user) {
                    DB::table('sessions')->where('user_id', $user->id)->delete();
                    $user->roles()->detach();
                    $user->delete();   // accounts, notas, IPs se borran en cascada
                });
                $deleted[] = $user->name;
            } catch (\Throwable $e) {
                report($e);
                $skipped[] = $user->name;
            }
        }

        $message = count($deleted) ? 'Eliminado(s): ' . implode(', ', $deleted) . '.' : '';
        if ($skipped) {
            $message .= ' No se borraron (tienen datos): ' . implode(', ', $skipped) . '.';
        }
        session()->flash('users_deleted', trim($message));

        if (count($deleted) && $this->getPage() > 1) {
            $this->resetPage();
        }
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
