<?php

namespace App\Livewire\Admin\Attendance;

use App\Http\Controllers\Admin\Attendance\AttendanceController;
use App\Models\Attendance;
use App\Models\Employee;
use Livewire\Component;

class PayrollIndex extends Component
{
    public $employee_id = '';
    public $location = '';
    public $date_from;
    public $date_to;

    public function mount()
    {
        $this->date_from = today()->subDays(6)->toDateString();
        $this->date_to = today()->toDateString();
    }

    public function render()
    {
        $employees = Employee::orderBy('name')->get();
        $locations = Attendance::whereNotNull('location')->distinct()->orderBy('location')->pluck('location');

        $rows = AttendanceController::buildPayroll(
            $this->date_from,
            $this->date_to,
            $this->employee_id ?: null,
            $this->location ?: null
        );

        $total = collect($rows)->sum('amount');

        return view('livewire.admin.attendance.payroll-index', compact('rows', 'employees', 'locations', 'total'));
    }

    public function printUrl()
    {
        return route('admin.attendance.payroll.print', [
            'employee_id' => $this->employee_id,
            'location' => $this->location,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
        ]);
    }
}
