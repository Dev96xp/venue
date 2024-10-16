<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tax::create([
            'name' => 'tax 1',
            'tax' => 7,
        ]);

        Tax::create([
            'name' => 'tax 2',
            'tax' => 7.5,
        ]);

        Tax::create([
            'name' => 'tax 3',
            'tax' => 1.5,
        ]);
    }
}
