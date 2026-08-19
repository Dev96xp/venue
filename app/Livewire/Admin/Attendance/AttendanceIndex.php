<?php

namespace App\Livewire\Admin\Attendance;

use App\Models\Attendance;
use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $employee_id = '';
    public $location = '';
    public $date_from;
    public $date_to;

    public ?int $editId = null;
    public $editCheckOut = '';

    public function mount()
    {
        $this->date_from = today()->subDays(6)->toDateString();
        $this->date_to = today()->toDateString();
    }

    public function updating($property)
    {
        if (in_array($property, ['employee_id', 'location', 'date_from', 'date_to'])) {
            $this->resetPage();
        }
    }

    #[On('render-attendance')]
    public function render()
    {
        $employees = Employee::orderBy('name')->get();
        $locations = Attendance::whereNotNull('location')->distinct()->orderBy('location')->pluck('location');

        $attendances = Attendance::with('employee')
            ->when($this->employee_id, fn ($q) => $q->where('employee_id', $this->employee_id))
            ->when($this->location, fn ($q) => $q->where('location', $this->location))
            ->whereDate('check_in', '>=', $this->date_from)
            ->whereDate('check_in', '<=', $this->date_to)
            ->orderBy('check_in', 'desc')
            ->paginate(15);

        return view('livewire.admin.attendance.attendance-index', compact('attendances', 'employees', 'locations'));
    }

    public function editAttendance(int $attendanceId)
    {
        $attendance = Attendance::findOrFail($attendanceId);
        $this->editId = $attendance->id;
        $this->editCheckOut = optional($attendance->check_out)->format('Y-m-d\TH:i');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editCheckOut = '';
    }

    public function saveEdit()
    {
        $attendance = Attendance::findOrFail($this->editId);

        $this->validate([
            'editCheckOut' => 'required|date|after_or_equal:'.optional($attendance->check_in)->format('Y-m-d\TH:i'),
        ]);

        $attendance->update(['check_out' => $this->editCheckOut]);

        $this->editId = null;
        $this->editCheckOut = '';
        $this->dispatch('render-attendance');
    }

    public function printUrl()
    {
        return route('admin.attendance.print', [
            'employee_id' => $this->employee_id,
            'location' => $this->location,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
        ]);
    }
}
