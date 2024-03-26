<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\Invite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        Invite::create([
            'name' => 'Quinceañera invitation Diamante',
            'description' => 'nada',
        ]);
        Invite::create([
            'name' => 'Quinceañera invitation Silver',
            'description' => 'nada',
        ]);
        Invite::create([
            'name' => 'Quinceañera invitation Bronce',
            'description' => 'nada',
        ]);
        Invite::create([
            'name' => 'Quinceañera invitation copper',
            'description' => 'nada',
        ]);

    }
}
