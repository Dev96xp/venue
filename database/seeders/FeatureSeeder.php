<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::create([
            'name' => 'quantity'
        ]);
        Feature::create([
            'name' => 'color'
        ]);
        Feature::create([
            'name' => 'bust'
        ]);
        Feature::create([
            'name' => 'waist'
        ]);
        Feature::create([
            'name' => 'hip'
        ]);
        Feature::create([
            'name' => 'size'
        ]);
        Feature::create([
            'name' => 'date'
        ]);
        Feature::create([
            'name' => 'coupon'
        ]);
        Feature::create([
            'name' => 'description'
        ]);
        Feature::create([
            'name' => 'note1'  //10
        ]);
        Feature::create([
            'name' => 'note2'
        ]);
        Feature::create([
            'name' => 'note3'
        ]);
        Feature::create([
            'name' => 'video1'
        ]);
        Feature::create([
            'name' => 'video2'
        ]);
        Feature::create([
            'name' => 'image1'  //15
        ]);
        Feature::create([
            'name' => 'image2'
        ]);
        Feature::create([
            'name' => 'image3'
        ]);
        Feature::create([
            'name' => 'price'
        ]);
        Feature::create([
            'name' => 'web_price'
        ]);
        Feature::create([
            'name' => 'days1'  //20
        ]);
        Feature::create([
            'name' => 'days2'
        ]);
        Feature::create([
            'name' => 'days3'
        ]);
        Feature::create([
            'name' => 'tag1'
        ]);
        Feature::create([
            'name' => 'tag2'
        ]);
    }
}
