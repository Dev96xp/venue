<?php

namespace App\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class PermissionIndex extends Component
{
    // Se agrego estas lineas para usar la paginacion en el formulario
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render'];

    public $numbers = 6;

    public function render()
    {
        $permissions = Permission::where('name', '<>', 'nada')
            ->paginate($this->numbers);

        return view('livewire.admin.permission.permission-index', compact('permissions'));
    }
}
