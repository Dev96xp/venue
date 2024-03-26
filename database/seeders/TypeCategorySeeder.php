<?php

namespace Database\Seeders;

use App\Models\TypeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCategory::create([
            'name' => 'PRODUCT'
        ]);
        TypeCategory::create([
            'name' => 'PACKAGE'
        ]);
        TypeCategory::create([
            'name' => 'OPEN'
        ]);
    }
}
