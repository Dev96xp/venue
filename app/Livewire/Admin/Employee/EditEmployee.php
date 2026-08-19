<?php

namespace App\Livewire\Admin\Employee;

use App\Models\Employee;
use Livewire\Component;

class EditEmployee extends Component
{
    public $open = false;
    public Employee $employee;

    public $name = '';
    public $email = '';
    public $password = '';
    public $role = '';
    public $salary = '';
    public $salary_period = '';
    public $status = '';

    public function mount(Employee $employee)
    {
        $this->employee = $employee;
        $this->name = $employee->name;
        $this->email = $employee->email;
        $this->role = $employee->role;
        $this->salary = $employee->salary;
        $this->salary_period = $employee->salary_period;
        $this->status = $employee->status;
    }

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:employees,email,'.$this->employee->id,
            'password' => 'nullable|min:8',
            'role' => 'nullable|max:255',
            'salary' => 'nullable|numeric|min:0',
            'salary_period' => 'nullable|in:'.implode(',', Employee::SALARY_PERIODS),
            'status' => 'required|in:'.implode(',', Employee::STATUSES),
        ];
    }

    public function render()
    {
        return view('livewire.admin.employee.edit-employee');
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role ?: null,
            'salary' => $this->salary !== '' ? $this->salary : null,
            'salary_period' => $this->salary_period ?: null,
            'status' => $this->status,
        ];

        if (filled($this->password)) {
            $data['password'] = $this->password;
        }

        $this->employee->update($data);

        $this->reset(['open', 'password']);
        $this->dispatch('render-employees');
    }
}
