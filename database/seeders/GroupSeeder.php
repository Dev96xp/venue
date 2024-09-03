<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'name'=>'Sizes 0-18'
        ]);
        Group::create([
            'name'=>'Sizes 0-20'
        ]);
        Group::create([
            'name'=>'Sizes 0-22'
        ]);
        Group::create([
            'name'=>'Sizes 0-24'
        ]);
        Group::create([
            'name'=>'Sizes 0-26'
        ]);
        Group::create([
            'name'=>'Sizes 0-28'
        ]);
        Group::create([
            'name'=>'Sizes 0-30'
        ]);
        Group::create([
            'name'=>'Sizes 0-32'
        ]);
        Group::create([
            'name'=>'Sizes 0-34'
        ]);
        Group::create([
            'name'=>'Sizes sm-lg'
        ]);
        Group::create([
            'name'=>'Sizes xs-lg'
        ]);
        Group::create([
            'name'=>'Sizes xs-xl'
        ]);
        Group::create([
            'name'=>'Sizes xs-2xl'
        ]);
        Group::create([
            'name'=>'Sizes xs-3xl'
        ]);
        Group::create([
            'name'=>'Sizes xs-4xl'
        ]);
    }
}
