<?php

namespace Database\Seeders;

use App\Models\Part;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Part::create([
            'name' => 'Parte 1 - una cosa',
            'description' => 'una cosa',
            'url' => 'nada',
            'section_id' => 1,
        ]);

        Part::create([
            'name' => 'Parte 2 - otra cosa',
            'description' => 'otra cosa',
            'url' => 'nada',
            'section_id' => 1,
        ]);

        Part::create([
            'name' => 'Parte 3 - una adicional',
            'description' => 'una adicional',
            'url' => 'nada',
            'section_id' => 1,
        ]);


        Part::create([
            'name' => 'Parte 1 - una cosa',
            'description' => 'una cosa',
            'url' => 'nada',
            'section_id' => 2,
        ]);

        Part::create([
            'name' => 'Parte 2 - otra cosa',
            'description' => 'otra cosa',
            'url' => 'nada',
            'section_id' => 2,
        ]);

        /* **************/
        Part::create([
            'name' => 'Parte 1 - Verso #2 grande',
            'description' => 'Escribier el verso grande',
            'url' => 'nada',
            'section_id' => 3,
        ]);

        Part::create([
            'name' => 'Parte 2 - Backround',
            'description' => 'Subir imagen de background',
            'url' => 'nada',
            'section_id' => 3,
        ]);

        Part::create([
            'name' => 'Parte 3 - titulo de la invitacion',
            'description' => 'Poner que tipo de invitacion, ejemplo "XV anos" ',
            'url' => 'nada',
            'section_id' => 3,
        ]);

        Part::create([
            'name' => 'Parte 3 - Festejado o festejados',
            'description' => 'Poner el nombre del festejado',
            'url' => 'nada',
            'section_id' => 3,
        ]);
    }
}
