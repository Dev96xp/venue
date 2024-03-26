<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            'name' => 'Oakview',
            'code' => 'oakview',
            'address' => '3001 S 144th St, Omaha, NE 68144',
            'city' => 'Omaha',
            'state' =>  'NE',
            'phone' => '402-884-9950',
            'zip' => '68144'
        ]);

        Store::create([
            'name' => 'Kansas',
            'code' => 'Kansas',
            'address' => '10000 California St Suite 1221, Omaha, NE 68114',
            'city' => 'Kansas',
            'state' =>  'MO',
            'zip' => '68144'
        ]);


        Store::create([
            'name' => 'Southerhills',
            'code' => 'southerhills',
            'address' => '4400 Sergeant Rd Ste 317, Sioux City, IA 51106',
            'city' => 'Sioux City',
            'state' =>  'IA'
        ]);

        Store::create([
            'name' => 'Grand Island',
            'code' => 'downtown',
            'address' => '315 West 3rd st, Grand Island, NE 68801',
            'city' => 'Grand Island',
            'state' =>  'NE',
            'phone' => '308-746-4108',
            'zip' => '68801'
        ]);

        Store::create([
            'name' => 'Miami',
            'code' => 'coralgables',
            'address' => 'Conocido, Coral Gables, Florida 68801',
            'city' => 'Coral Gables',
            'state' =>  'FL',
            'phone' => '308-746-4108',
            'zip' => '68801'
        ]);

        Store::create([
            'name' => 'Online',
            'code' => 'web',
            'address' => '315 West 3rd st, Grand Island, NE 68801',
            'city' => 'Conocido',
            'state' =>  'NE',
            'phone' => '308-746-4108',
            'zip' => '68801'
        ]);
    }
}
