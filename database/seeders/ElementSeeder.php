<?php

namespace Database\Seeders;

use App\Models\Element;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elements = [
            ['name' => 'Salon',
             'code' => 'C800'],
            ['name' => 'Mesas y sillas',
             'code' => 'C810'],
            ['name' => 'Personal',
             'code' => 'C820'],
            ['name' => 'Limpieza',
             'code' => 'C830'],
            ['name' => 'Alcohol',
             'code' => 'C840'],
            ['name' => 'Decoration',
             'code' => 'C850'],
            ['name' => 'Meseros',
             'code' => 'C860'],
            ['name' => 'Cordinator',
             'code' => 'C870'],
            ['name' => 'Bartender',
             'code' => 'C880'],
            ['name' => 'Dance Floor',
             'code' => 'C890'],
        ];

        foreach ($elements as $element) {
            Element::create($element);
        }
    }
}
