<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        Section::create([
            'name' => 'Secction 1 - Fotografia principal y nombre',
            'description' => 'Es la parte mas alta de la invitacion',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 2 - Verso #1 y Foto',
            'description' => 'Aqui se pone el verso y foto',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 3 - background, titulo, nombre y verso #2 grande',
            'description' => 'Aqui se pone 4 cosas: (background, "mis xv años", nombre, verso #2 grande)',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 4 - Papas',
            'description' => 'Los papas(2)',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 5 - Padrinos',
            'description' => 'Los padrinos(2)',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 6 - Conteo',
            'description' => 'Conteo regesivo',
            'invitation_id' => 1,
        ]);
        Section::create([
            'name' => 'Seccion 7 - Iglesia',
            'description' => 'Todos los datos de la iglesia',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 8 - Salon',
            'description' => 'Todos los datos del salon',
            'invitation_id' => 1,
        ]);
        Section::create([
            'name' => 'Seccion 9 - Programa',
            'description' => 'El programa de la fiesta',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 9 - Galeria de Fotos',
            'description' => 'Aqui se pone el verso',
            'invitation_id' => 1,
        ]);
        Section::create([
            'name' => 'Seccion 10 - Video galeria',
            'description' => 'Video con galeria de fotos de 10 fotos aprox, 1 min',
            'invitation_id' => 1,
        ]);
        Section::create([
            'name' => 'Seccion 11 - Tema especial(mariposas etc)',
            'description' => 'Agregar un tema especial',
            'invitation_id' => 1,
        ]);

        Section::create([
            'name' => 'Seccion 12 - Musica',
            'description' => 'Agregar musica',
            'invitation_id' => 1,
        ]);

        //***************************invitacion 2 */
        Section::create([
            'name' => 'Secction 1 - Fotografia principal y nombre',
            'description' => 'Es la parte mas alta de la invitacion',
            'invitation_id' => 2,
        ]);

        Section::create([
            'name' => 'Seccion 2 - Verso #1 y Foto',
            'description' => 'Aqui se pone el verso',
            'invitation_id' => 2,
        ]);

        Section::create([
            'name' => 'Seccion 3 - background, titulo, nombre y verso #2 grande',
            'description' => 'Aqui se pone 4 cosas: (background, "mis xv años", nombre, verso #2 grande)',
            'invitation_id' => 2,
        ]);
    }
}
