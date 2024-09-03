<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sizes = [
            'Size 0',
            'Size 2',
            'Size 4',
            'Size 6',
            'Size 8',
            'Size 10',
            'Size 12',
            'Size 14',
            'Size 16',
            'Size 18',
            'Size 20',
            'Size 22',
            'Size 24',
            'Size 26',
            'Size 28',
            'Size 30',
            'xsmall',
            'small',
            'medium',
            'large',
            'x-large',
            '2x-large',
            '3x-large',
            '4x-large',
            '5x-large',
            '6x-large',
            '7x-large',
            '8x-large',
        ];

        foreach ($sizes as $size) {
            Size::create([
                'name' => $size
            ]);
        }


        // ############# METODO 3###############
        // Size::create([
        //     'name' => '00-18'
        // ]);
        // Size::create([
        //     'name' => '00-20'
        // ]);
        // Size::create([
        //     'name' => '00-24'
        // ]);
        // Size::create([
        //     'name' => '00-26'
        // ]);
        // Size::create([
        //     'name' => '00-28'
        // ]);
        // Size::create([
        //     'name' => 'XS-XL'
        // ]);
        // Size::create([
        //     'name' => 'XS-2XL'
        // ]);
        // Size::create([
        //     'name' => 'SX-3XL'
        // ]);
    }
}
