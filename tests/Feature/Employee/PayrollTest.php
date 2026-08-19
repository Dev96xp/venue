<?php

namespace Tests\Feature\Employee;

use App\Http\Controllers\Admin\Attendance\AttendanceController;
use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PayrollTest extends TestCase
{
    use RefreshDatabase;

    public function test_hourly_employee_is_paid_hours_times_rate(): void
    {
        $employee = Employee::factory()->create([
            'salary' => 20,
            'salary_period' => Employee::PERIOD_HOURLY,
        ]);

        Attendance::factory()->create([
            'employee_id' => $employee->id,
            'check_in' => today()->setTime(9, 0),
            'check_out' => today()->setTime(13, 0), // 4 hours
        ]);

        $rows = AttendanceController::buildPayroll(today()->toDateString(), today()->toDateString());

        $this->assertCount(1, $rows);
        $this->assertEquals(80.0, $rows[0]['amount']);
        $this->assertEquals(4.0, $rows[0]['hours']);
    }

    public function test_monthly_employee_is_paid_full_salary_regardless_of_hours(): void
    {
        $employee = Employee::factory()->create([
            'salary' => 3000,
            'salary_period' => Employee::PERIOD_MONTHLY,
        ]);

        Attendance::factory()->create([
            'employee_id' => $employee->id,
            'check_in' => today()->setTime(9, 0),
            'check_out' => today()->setTime(10, 0), // just 1 hour
        ]);

        $rows = AttendanceController::buildPayroll(today()->subDays(2)->toDateString(), today()->toDateString());

        $this->assertCount(1, $rows);
        $this->assertEquals(3000.0, $rows[0]['amount']);
    }

    public function test_employees_without_attendance_in_range_are_excluded(): void
    {
        Employee::factory()->create([
            'salary' => 3000,
            'salary_period' => Employee::PERIOD_MONTHLY,
        ]);

        $rows = AttendanceController::buildPayroll(today()->toDateString(), today()->toDateString());

        $this->assertCount(0, $rows);
    }
}
