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
            'link' => 'https://www.ups.com/track?loc=en_US&requester=ST/'
        ]);

        ShippingCompany::create([
            'name' => 'Fedex Company',
            'link' => 'https://www.fedex.com/en-us/tracking.html'
        ]);

        ShippingCompany::create([
            'name' => 'Estafeta',
            'link' => 'https://www.estafeta.com/en/rastrear-envio'
        ]);

        ShippingCompany::create([
            'name' => 'USPS',
            'link' => 'https://tools.usps.com/go/TrackConfirmAction_input'
        ]);

        ShippingCompany::create([
            'name' => 'DHL',
            'link' => 'https://www.dhl.com/us-en/home/tracking.html'
        ]);
    }
}
