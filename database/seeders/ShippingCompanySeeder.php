<?php

namespace Database\Seeders;

use App\Models\ShippingCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingCompany::create([
            'name' => 'UPS Company',
            'link' => '1'
        ]);

        ShippingCompany::create([
            'name' => 'Fedex Company',
            'link' => '1'
        ]);

        ShippingCompany::create([
            'name' => 'Estafeta',
            'link' => '1'
        ]);
    }
}
