<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Detail::create([
            'name' => 'quantity'
        ]);
        Detail::create([
            'name' => 'color'
        ]);
        Detail::create([
            'name' => 'date'
        ]);
        Detail::create([
            'name' => 'description'
        ]);
        Detail::create([
            'name' => 'note1'
        ]);
        Detail::create([
            'name' => 'note2'
        ]);
        Detail::create([
            'name' => 'note3'
        ]);
        Detail::create([
            'name' => 'video'
        ]);
    }
}
