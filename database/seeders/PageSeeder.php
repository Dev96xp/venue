<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'name' => 'Page 1 - Home',
            'status' => 'ACTIVE',
        ]);
        Page::create([
            'name' => 'Page 2 - Gallery',
            'status' => 'ACTIVE',
        ]);
        Page::create([
            'name' => 'Page 3 - About',
            'status' => 'ACTIVE',
        ]);
    }
}
