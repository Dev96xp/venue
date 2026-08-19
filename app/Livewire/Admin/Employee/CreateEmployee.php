<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Employee;
use Livewire\Component;

class CreateEmployee extends Component
{
    public $open = false;

    public $name = '';
    public $email = '';
    public $password = '';
    public $role = '';
    public $salary = '';
    public $salary_period = '';
    public $status = Employee::STATUS_ACTIVE;

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email',
            'password' => 'required|min:8',
            'role' => 'nullable|max:255',
            'salary' => 'nullable|numeric|min:0',
            'salary_period' => 'nullable|in:'.implode(',', Employee::SALARY_PERIODS),
            'status' => 'required|in:'.implode(',', Employee::STATUSES),
        ];
    }

    public function render()
    {
        return view('livewire.admin.employee.create-employee');
    }

    public function save()
    {
        $this->validate();

        Employee::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role ?: null,
            'salary' => $this->salary !== '' ? $this->salary : null,
            'salary_period' => $this->salary_period ?: null,
            'status' => $this->status,
        ]);

        $this->reset(['open', 'name', 'email', 'password', 'role', 'salary', 'salary_period']);
        $this->status = Employee::STATUS_ACTIVE;

        $this->dispatch('render-employees');
    }
}
