<?php

namespace Database\Seeders;

use App\Models\StatusItem;
use App\Models\StatusItemsVenue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusItem::create([
            'name' => 'PENDIENTE'
        ]);
        StatusItem::create([
            'name' => 'PRODUCTION'
        ]);
        StatusItem::create([
            'name' => 'TERMINADO'
        ]);
        StatusItem::create([
            'name' => 'CANCELADO'
        ]);
    }
}
