<?php

namespace Database\Seeders;

use App\Models\Invitation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1
        Invitation::create([
            'name' => '308-746-1555 - Quinceañera para Susana - Agosto 25, 2024',
            'description' => 'Para Sussana',
            'model' => 'invite1',
            'type' => 'diamante',
            'user_id' => 1,
            'invite_id' => 1
        ]);

        Invitation::create([
            'name' => '308-746-1020 - Quinceañera para Lucia Jimenez - April 25, 2024',
            'description' => 'Para Lucia',
            'model' => 'invite2',
            'type' => 'silver',
            'user_id' => 2,
            'invite_id' => 2
        ]);

        Invitation::create([
            'name' => '402-746-1020 - Quinceañera para Perla - September 15, 2024',
            'description' => 'Para Perla',
            'model' => 'invite3',
            'type' => 'bronce',
            'user_id' => 3,
            'invite_id' => 3
        ]);

        Invitation::create([
            'name' => '308-746-1020 - Quinceañera para Lucia Jimenez - October 4, 2024',
            'description' => 'Para Lucia',
            'model' => 'invite1',
            'type' => 'diamante',
            'user_id' => 2,
            'invite_id' => 1
        ]);
    }
}
