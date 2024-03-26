<?php

namespace Database\Seeders;

use App\Models\PackageLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PackageLocation::create([
            'name' => 'EN CAJA'
        ]);
        PackageLocation::create([
            'name' => 'APARTADO EN TIENDA'
        ]);
        PackageLocation::create([
            'name' => 'ORDENADO - ESPERANDO A QUE LLEGUE'
        ]);
        PackageLocation::create([
            'name' => 'PRODUCTION'
        ]);
        PackageLocation::create([
            'name' => 'ENTREGADO A CLIENTE'
        ]);
        PackageLocation::create([
            'name' => 'ALTERATION'
        ]);
        PackageLocation::create([
            'name' => 'ALMACEN'
        ]);
        PackageLocation::create([
            'name' => 'STORE ZONA 1'
        ]);
        PackageLocation::create([
            'name' => 'STORE ZONA 2'
        ]);
        PackageLocation::create([
            'name' => 'STORE ZONA 3'
        ]);
        PackageLocation::create([
            'name' => 'STORE ZONA 4'
        ]);
        PackageLocation::create([
            'name' => 'STORE ZONA 5'
        ]);
    }
}
