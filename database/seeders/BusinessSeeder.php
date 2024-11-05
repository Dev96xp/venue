<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Business::create([
            'name' => 'THE PALACE HALL',
            'slogan' => 'Experiance and aptitude of our team',
            'description' => 'Perfect for hosting Weddings, Receptions, Corporate Events, Private Celebrations and More!',
            'address' => '3001 S 144th St',
            'city' => 'Omaha',
            'state' => 'NE',
            'zip' => '68144',
            'phone' => '308-746-4108',
            'phone2' => '308-746-4927',
            'link' => 'https://www.facebook.com/profile.php?id=100004629788695',
            'link3' => 'https://www.youtube.com/channel/UCwf9FLrQaJj-aj4WoAphnGQ',
        ]);
    }
}
