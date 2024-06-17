<?php

namespace Database\Seeders;

use App\Models\ItemsVenue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsVenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        ItemsVenue::create([
            'name' => 'name 1',
            'description' => 'wherever 1',
            'status' => 'active',
            'venue_id' => 1,
            'status_items_venue_id' => 3,
        ]);
        ItemsVenue::create([
            'name' => 'name 2',
            'description' => 'wherever 2',
            'status' => 'active',
            'venue_id' => 1,
            'status_items_venue_id' => 3,
        ]);
        ItemsVenue::create([
            'name' => 'name 3',
            'description' => 'wherever 3',
            'status' => 'active',
            'venue_id' => 1,
            'status_items_venue_id' => 3,
        ]);
        ItemsVenue::create([
            'name' => 'name 4',
            'description' => 'wherever 4',
            'status' => 'active',
            'venue_id' => 1,
            'status_items_venue_id' => 3,
        ]);

        ItemsVenue::create([
            'name' => 'name A',
            'description' => 'wherever AAA',
            'status' => 'active',
            'venue_id' => 2,
            'status_items_venue_id' => 3,
        ]);
        ItemsVenue::create([
            'name' => 'name B',
            'description' => 'wherever BBB',
            'status' => 'active',
            'venue_id' => 2,
            'status_items_venue_id' => 3,
        ]);
        ItemsVenue::create([
            'name' => 'name C',
            'description' => 'wherever CCC',
            'status' => 'active',
            'venue_id' => 2,
            'status_items_venue_id' => 3,
        ]);
        ItemsVenue::create([
            'name' => 'name D',
            'description' => 'wherever DDD',
            'status' => 'active',
            'venue_id' => 2,
            'status_items_venue_id' => 3,
        ]);
    }
}
