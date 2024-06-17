<?php

namespace Database\Seeders;

use App\Models\StatusItemsVenue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusItemsVenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusItemsVenue::create([
            'name' => 'PENDIENTE'
        ]);
        StatusItemsVenue::create([
            'name' => 'PRODUCTION'
        ]);
        StatusItemsVenue::create([
            'name' => 'TERMINADO'
        ]);
        StatusItemsVenue::create([
            'name' => 'CANCELADO'
        ]);
    }
}
