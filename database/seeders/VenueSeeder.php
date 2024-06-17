<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo es uno por evento
        //1
        Venue::create([
            'sku' => 'wewe',
            'name' => 'THE PALACE HALL #1 (oakview)',
            'description' => 'wherever 1',
            'status' => 'active',
            'note' => 'nada sss',
            'date' => now(),
            'event_id' => 1,
        ]);

        //1
        Venue::create([
            'sku' => 'sese',
            'name' => 'THE PALACE HALL #2 (kansas)',
            'description' => 'wherever 1',
            'status' => 'active',
            'note' => 'nada sss',
            'date' => now(),
            'event_id' => 2,
        ]);
    }
}
