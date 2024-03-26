<?php

namespace Database\Seeders;

use App\Models\StatusCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusCategory::create([
            'name' => 'ACTIVE'
        ]);
        StatusCategory::create([
            'name' => 'INACTIVE'
        ]);
        StatusCategory::create([
            'name' => 'PENDING'
        ]);
    }
}
