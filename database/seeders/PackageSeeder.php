<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'PLATINUM',
                'code' => 'THPLAT',
               //  'phone' => 'nada',
               //  'date' => now(),
               //  'store_id' => 1,
                'note' => '',
                'description' => '',
                'aux1' => '',
                'aux2' => '',
                'status' => 'ACTIVE'
            ],
            [
                'name' => 'PREMIUN',
                'code' => 'THPREM',
               //  'phone' => 'nada',
               //  'date' => now(),
               //  'store_id' => 1,
                'note' => '',
                'description' => '',
                'aux1' => '',
                'aux2' => '',
                'status' => 'ACTIVE'

            ],
            [
                'name' => 'DIAMONT',
                'code' => 'THDIAM',
               //  'phone' => 'nada',
               //  'date' => now(),
               //  'store_id' => 1,
                'note' => '',
                'description' => '',
                'aux1' => '',
                'aux2' => '',
                'status' => 'ACTIVE'
            ],
            [
                'name' => 'BRONZE',
                'code' => 'THBRON',
               //  'phone' => 'nada',
               //  'date' => now(),
               //  'store_id' => 1,
                'note' => '',
                'description' => '',
                'aux1' => '',
                'aux2' => '',
                'status' => 'ACTIVE'
            ],
            [
                'name' => 'SILVER',
                'code' => 'THSILV',
               //  'phone' => 'nada',
               //  'date' => now(),
               //  'store_id' => 1,
                'note' => '',
                'description' => '',
                'aux1' => '',
                'aux2' => '',
                'status' => 'ACTIVE'
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }


         $package = Package::find(1);
         $package->elements()->attach([1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]);

       //   $package = package::find(2);
       //   $package->elements()->attach([1, 2, 3, 4, 5]);

       //   $package = package::find(3);
       //   $package->elements()->attach([1, 2, 6, 7, 8, 9, 10]);

    }
}
