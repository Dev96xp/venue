<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockInController extends Controller
{
    public function show(Request $request)
    {
        $employee = Auth::guard('employee')->user();

        $open = Attendance::where('employee_id', $employee->id)
            ->whereDate('check_in', today())
            ->whereNull('check_out')
            ->first();

        $locationName = $request->query('location', $open->location ?? null);

        $location = $locationName
            ? Location::where('name', $locationName)->first()
            : null;

        return view('employee.clock-in', [
            'open' => $open,
            'locationName' => $locationName,
            'location' => $location,
        ]);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $employee = Auth::guard('employee')->user();

        $open = Attendance::where('employee_id', $employee->id)
            ->whereDate('check_in', today())
            ->whereNull('check_out')
            ->first();

        if ($open) {
            $open->update(['check_out' => now()]);

            return redirect()->route('employee.clock-in')->with('status', 'Salida registrada.');
        }

        $locationName = $request->input('location');
        $location = $locationName ? Location::where('name', $locationName)->first() : null;

        if ($location && $location->hasCoordinates()) {
            if (! $request->filled('latitude') || ! $request->filled('longitude')) {
                return back()->withErrors([
                    'geolocation' => 'Se requiere tu ubicación para registrar la entrada en este edificio.',
                ]);
            }

            if (! $location->isWithinRadius((float) $request->input('latitude'), (float) $request->input('longitude'))) {
                return back()->withErrors([
                    'geolocation' => "Estás fuera del radio permitido ({$location->radius_feet} pies) de {$location->name}.",
                ]);
            }
        }

        Attendance::create([
            'employee_id' => $employee->id,
            'location' => $locationName,
            'check_in' => now(),
        ]);

        return redirect()->route('employee.clock-in')->with('status', 'Entrada registrada.');
    }
}
