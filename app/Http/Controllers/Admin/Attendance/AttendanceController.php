<?php

namespace App\Http\Controllers\Admin\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('admin.attendance.index');
    }

    public function print(Request $request)
    {
        $dateFrom = $request->query('date_from', today()->subDays(6)->toDateString());
        $dateTo = $request->query('date_to', today()->toDateString());

        $attendances = Attendance::with('employee')
            ->when($request->query('employee_id'), fn ($q, $employeeId) => $q->where('employee_id', $employeeId))
            ->when($request->query('location'), fn ($q, $location) => $q->where('location', $location))
            ->whereDate('check_in', '>=', $dateFrom)
            ->whereDate('check_in', '<=', $dateTo)
            ->orderBy('check_in', 'desc')
            ->get();

        return view('admin.attendance.print', compact('attendances', 'dateFrom', 'dateTo'));
    }

    public function payroll(Request $request)
    {
        return view('admin.attendance.payroll');
    }

    public function payrollPrint(Request $request)
    {
        $dateFrom = $request->query('date_from', today()->subDays(6)->toDateString());
        $dateTo = $request->query('date_to', today()->toDateString());

        $rows = $this->buildPayroll($dateFrom, $dateTo, $request->query('employee_id'), $request->query('location'));

        return view('admin.attendance.payroll-print', [
            'rows' => $rows,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'total' => collect($rows)->sum('amount'),
        ]);
    }

    public static function buildPayroll(string $dateFrom, string $dateTo, ?string $employeeId = null, ?string $location = null): array
    {
        $employees = Employee::when($employeeId, fn ($q, $id) => $q->where('id', $id))->get();

        $rows = [];

        foreach ($employees as $employee) {
            $attendances = $employee->attendances()
                ->when($location, fn ($q, $loc) => $q->where('location', $loc))
                ->whereDate('check_in', '>=', $dateFrom)
                ->whereDate('check_in', '<=', $dateTo)
                ->get();

            if ($attendances->isEmpty()) {
                continue;
            }

            $minutes = $attendances->sum(function (Attendance $attendance) {
                if (! $attendance->check_in || ! $attendance->check_out) {
                    return 0;
                }

                return $attendance->check_in->diffInMinutes($attendance->check_out);
            });

            $hours = round($minutes / 60, 2);

            if ($employee->salary_period === Employee::PERIOD_HOURLY) {
                $amount = round($hours * (float) $employee->salary, 2);
            } else {
                $amount = round((float) $employee->salary, 2);
            }

            $rows[] = [
                'employee' => $employee,
                'hours' => $hours,
                'amount' => $amount,
            ];
        }

        return $rows;
    }
}
