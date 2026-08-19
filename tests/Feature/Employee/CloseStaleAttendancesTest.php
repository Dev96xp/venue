<?php

namespace Tests\Feature\Employee;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CloseStaleAttendancesTest extends TestCase
{
    use RefreshDatabase;

    public function test_closes_only_open_shifts_from_previous_days(): void
    {
        $employee = Employee::factory()->create();

        $todayOpen = Attendance::factory()->create([
            'employee_id' => $employee->id,
            'check_in' => now(),
            'check_out' => null,
        ]);

        $yesterdayOpen = Attendance::factory()->create([
            'employee_id' => $employee->id,
            'check_in' => now()->subDay(),
            'check_out' => null,
        ]);

        $this->artisan('attendance:close-stale')->assertExitCode(0);

        $this->assertNull($todayOpen->fresh()->check_out);
        $this->assertNotNull($yesterdayOpen->fresh()->check_out);
    }
}
