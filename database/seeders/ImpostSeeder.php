<?php

namespace Database\Seeders;

use App\Models\Impost;
use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Impost::create([
            'name' => 'Grupo de taxes 1'
        ]);

        Impost::create([
            'name' => 'Grupo de taxes 2'
        ]);

        Impost::create([
            'name' => 'Grupo de taxes 3'
        ]);

        $imposts = Impost::all();

        foreach ($imposts as $impost) {
            // Hay una relacion MUCHOS A MUCHOS, se agrtegan unos registros a las tabla intermedia
            $taxs = Tax::all();
            foreach ($taxs as $tax) {
                $tax->imposts()->attach($impost->id);
            }
        }
    }
}
