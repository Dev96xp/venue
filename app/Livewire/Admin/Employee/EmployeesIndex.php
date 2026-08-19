<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public ?int $deleteId = null;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('render-employees')]
    public function render()
    {
        $employees = Employee::where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orWhere('employee_code', 'LIKE', '%'.$this->search.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.employee.employees-index', compact('employees'));
    }

    public function confirmDelete(int $employeeId)
    {
        $this->deleteId = $employeeId;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function delete()
    {
        Employee::whereKey($this->deleteId)->delete();
        $this->deleteId = null;
        $this->dispatch('render-employees');
    }
}
