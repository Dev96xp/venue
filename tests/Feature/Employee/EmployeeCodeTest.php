<?php

namespace Tests\Feature\Employee;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_code_is_generated_on_create(): void
    {
        $employee = Employee::factory()->create(['name' => 'Ana Martinez']);

        $this->assertNotNull($employee->employee_code);
        $this->assertStringStartsWith('ANAM-'.now()->format('ymd').'-', $employee->employee_code);
    }

    public function test_employee_code_is_unique(): void
    {
        $first = Employee::factory()->create(['name' => 'Carlos Diaz']);
        $second = Employee::factory()->create(['name' => 'Carlos Diaz']);

        $this->assertNotEquals($first->employee_code, $second->employee_code);
    }

    public function test_short_name_is_padded_with_x(): void
    {
        $employee = Employee::factory()->create(['name' => 'Al']);

        $this->assertStringStartsWith('ALXX-', $employee->employee_code);
    }

    public function test_active_employees_count_excludes_vacation_and_suspended(): void
    {
        Employee::factory()->create(['status' => Employee::STATUS_ACTIVE]);
        Employee::factory()->create(['status' => Employee::STATUS_ACTIVE]);
        Employee::factory()->create(['status' => Employee::STATUS_VACATION]);
        Employee::factory()->create(['status' => Employee::STATUS_SUSPENDED]);
        Employee::factory()->create(['status' => Employee::STATUS_INACTIVE]);

        $activeCount = Employee::where('status', Employee::STATUS_ACTIVE)->count();

        $this->assertEquals(2, $activeCount);
    }
}
