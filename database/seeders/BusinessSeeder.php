<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Business::create([
            'name' => 'THE PALACE HALL',
            'slogan' => 'Experiance and aptitude of our team',
            'description' => 'Perfect for hosting Weddings, Receptions, Corporate Events, Private Celebrations and More!'
        ]);
    }
}
