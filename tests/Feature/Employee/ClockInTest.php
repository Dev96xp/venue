<?php

namespace Tests\Feature\Employee;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClockInTest extends TestCase
{
    use RefreshDatabase;

    public function test_employee_login_redirects_to_clock_in(): void
    {
        $employee = Employee::factory()->create(['password' => 'secret123']);

        $response = $this->post('/clock-in/login', [
            'email' => $employee->email,
            'password' => 'secret123',
        ]);

        $this->assertAuthenticated('employee');
        $response->assertRedirect(route('employee.clock-in'));
    }

    public function test_toggle_clocks_in_then_out_creating_a_single_record(): void
    {
        $employee = Employee::factory()->create();

        $this->actingAs($employee, 'employee')
            ->post('/clock-in')
            ->assertRedirect(route('employee.clock-in'));

        $this->assertDatabaseCount('attendances', 1);
        $this->assertNull(Attendance::first()->check_out);

        $this->actingAs($employee, 'employee')
            ->post('/clock-in')
            ->assertRedirect(route('employee.clock-in'));

        $this->assertDatabaseCount('attendances', 1);
        $this->assertNotNull(Attendance::first()->fresh()->check_out);
    }

    public function test_location_query_param_is_saved_on_check_in(): void
    {
        $employee = Employee::factory()->create();

        $this->actingAs($employee, 'employee')
            ->post('/clock-in', ['location' => 'Main Hall']);

        $this->assertDatabaseHas('attendances', [
            'employee_id' => $employee->id,
            'location' => 'Main Hall',
        ]);
    }

    public function test_clock_in_blocked_outside_radius(): void
    {
        $employee = Employee::factory()->create();
        Location::factory()->create([
            'name' => 'Main Hall',
            'latitude' => 25.7617,
            'longitude' => -80.1918,
            'radius_feet' => 100,
        ]);

        $response = $this->actingAs($employee, 'employee')->post('/clock-in', [
            'location' => 'Main Hall',
            'latitude' => 25.7717,
            'longitude' => -80.2018,
        ]);

        $response->assertSessionHasErrors('geolocation');
        $this->assertDatabaseCount('attendances', 0);
    }

    public function test_clock_in_allowed_inside_radius(): void
    {
        $employee = Employee::factory()->create();
        Location::factory()->create([
            'name' => 'Main Hall',
            'latitude' => 25.7617,
            'longitude' => -80.1918,
            'radius_feet' => 300,
        ]);

        $response = $this->actingAs($employee, 'employee')->post('/clock-in', [
            'location' => 'Main Hall',
            'latitude' => 25.76173,
            'longitude' => -80.1918,
        ]);

        $response->assertRedirect(route('employee.clock-in'));
        $this->assertDatabaseCount('attendances', 1);
    }

    public function test_clock_in_has_no_restriction_when_location_has_no_coordinates(): void
    {
        $employee = Employee::factory()->create();
        Location::factory()->create(['name' => 'Main Hall', 'latitude' => null, 'longitude' => null]);

        $response = $this->actingAs($employee, 'employee')->post('/clock-in', [
            'location' => 'Main Hall',
        ]);

        $response->assertRedirect(route('employee.clock-in'));
        $this->assertDatabaseCount('attendances', 1);
    }
}
