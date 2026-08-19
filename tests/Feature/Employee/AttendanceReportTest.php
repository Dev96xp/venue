<?php

namespace Tests\Feature\Employee;

use App\Livewire\Admin\Attendance\AttendanceIndex;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AttendanceReportTest extends TestCase
{
    use RefreshDatabase;

    private function actingAsAdmin(): void
    {
        $store = Store::factory()->create([
            'code' => 'TEST',
            'name' => 'Test Store',
            'address' => '123 Test St',
            'city' => 'Testville',
            'state' => 'TS',
        ]);

        $this->actingAs(User::factory()->create(['store_id' => $store->id]));
    }

    public function test_default_date_range_is_last_seven_days(): void
    {
        $this->actingAsAdmin();

        Livewire::test(AttendanceIndex::class)
            ->assertSet('date_from', today()->subDays(6)->toDateString())
            ->assertSet('date_to', today()->toDateString());
    }

    public function test_report_filters_by_employee(): void
    {
        $this->actingAsAdmin();

        $matching = Employee::factory()->create();
        $other = Employee::factory()->create();

        Attendance::factory()->create(['employee_id' => $matching->id, 'check_in' => now()]);
        Attendance::factory()->create(['employee_id' => $other->id, 'check_in' => now()]);

        Livewire::test(AttendanceIndex::class)
            ->set('employee_id', $matching->id)
            ->assertViewHas('attendances', function ($attendances) use ($matching, $other) {
                return $attendances->pluck('employee_id')->contains($matching->id)
                    && ! $attendances->pluck('employee_id')->contains($other->id);
            });
    }

    public function test_admin_can_manually_edit_check_out(): void
    {
        $this->actingAsAdmin();

        $employee = Employee::factory()->create();
        $attendance = Attendance::factory()->create([
            'employee_id' => $employee->id,
            'check_in' => today()->setTime(9, 0),
            'check_out' => null,
        ]);

        Livewire::test(AttendanceIndex::class)
            ->call('editAttendance', $attendance->id)
            ->set('editCheckOut', today()->setTime(17, 0)->format('Y-m-d\TH:i'))
            ->call('saveEdit');

        $this->assertNotNull($attendance->fresh()->check_out);
    }
}
