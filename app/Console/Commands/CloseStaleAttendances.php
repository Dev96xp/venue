<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use Illuminate\Console\Command;

class CloseStaleAttendances extends Command
{
    protected $signature = 'attendance:close-stale';

    protected $description = 'Cierra automáticamente los turnos de asistencia que quedaron abiertos en días anteriores';

    public function handle(): void
    {
        $closed = Attendance::whereNull('check_out')
            ->whereDate('check_in', '<', today())
            ->update(['check_out' => now()]);

        $this->info("Turnos cerrados: {$closed}");
    }
}
