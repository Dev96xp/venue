<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'name' => 'Cash',
            'code' => 'CA',
            'signo' => false
        ]);
        Payment::create([
            'name' => 'Visa',
            'code' => 'VI',
            'signo' => false
        ]);
        Payment::create([
            'name' => 'Check',
            'code' => 'CH',
            'signo' => false
        ]);
        Payment::create([
            'name' => 'Credict Card',
            'code' => 'CR',
            'signo' => false
        ]);
        Payment::create([
            'name' => 'Gift Card',
            'code' => 'GI',
            'signo' => true
        ]);
        Payment::create([
            'name' => 'Special Descount',
            'code' => 'SD',
            'signo' => true
        ]);
        Payment::create([
            'name' => 'Diferencia de Vestido',
            'code' => 'SV',
            'signo' => 3
        ]);
        Payment::create([
            'name' => 'Alteration',
            'code' => 'AL',
            'signo' => 3
        ]);
        Payment::create([
            'name' => 'Discount Coupon',
            'code' => 'DC',
            'signo' => 2
        ]);
    }
}
