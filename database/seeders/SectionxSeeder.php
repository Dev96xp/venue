<?php

namespace Database\Seeders;

use App\Models\Sectionx;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sectionx::create([
            'name' => 'Home',
            'status' => 'ACTIVE',
            'page_id' => 1,
        ]);
        Sectionx::create([
            'name' => 'At your service',
            'status' => 'ACTIVE',
            'page_id' => 1,
        ]);
        Sectionx::create([
            'name' => 'Where are work',
            'status' => 'ACTIVE',
            'page_id' => 1,
        ]);
        Sectionx::create([
            'name' => 'Seccion X - Big image',
            'status' => 'ACTIVE',
            'page_id' => 1,
        ]);
        Sectionx::create([
            'name' => 'Head Image',
            'status' => 'ACTIVE',
            'page_id' => 2,
        ]);
        Sectionx::create([
            'name' => 'Gallery',
            'status' => 'ACTIVE',
            'page_id' => 2,
        ]);
    }
}
