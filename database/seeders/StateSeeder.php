<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // NUEVO
        $usSatates = [
            ["name" => "Alabama", "code" => "AL", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Alaska", "code" => "AK", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Arizona", "code" => "AZ", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Arkansas", "code" => "AR", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "California", "code" => "CA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Colorado", "code" => "CO", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Connecticut", "code" => "CT", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Delaware", "code" => "DE", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "District of Columbia", "code" => "DC", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Florida", "code" => "FL", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Georgia", "code" => "GA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Hawaii", "code" => "HI", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Idaho", "code" => "ID", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Illinois", "code" => "IL", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Indiana", "code" => "IN", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Iowa", "code" => "IA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Kansas", "code" => "KS", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Kentucky", "code" => "KY", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Louisiana", "code" => "LA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Maine", "code" => "ME", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Maryland", "code" => "MD", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Massachusetts", "code" => "MA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Michigan", "code" => "MI", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Minnesota", "code" => "MN", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Mississippi", "code" => "MS", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Missouri", "code" => "MO", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Montana", "code" => "MT", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Nebraska", "code" => "NE", "shipping_cost" => 25, "country_id" => 1],
            ["name" => "Nevada", "code" => "NV", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "New Hampshire", "code" => "NH", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "New Jersey", "code" => "NJ", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "New Mexico", "code" => "NM", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "New York", "code" => "NY", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "North Carolina", "code" => "NC", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "North Dakota", "code" => "ND", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Ohio", "code" => "OH", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Oklahoma", "code" => "OK", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Oregon", "code" => "OR", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Pennsylvania", "code" => "PA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Rhode Island", "code" => "RI", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "South Carolina", "code" => "SC", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "South Dakota", "code" => "SD", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Tennessee", "code" => "TN", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Texas", "code" => "TX", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Utah", "code" => "UT", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Vermont", "code" => "VT", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Virginia", "code" => "VA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Washington", "code" => "WA", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "West Virginia", "code" => "WV", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Wisconsin", "code" => "WI", "shipping_cost" => 35, "country_id" => 1],
            ["name" => "Wyoming", "code" => "WY", "shipping_cost" => 35, "country_id" => 1]
        ];

        foreach ($usSatates as $key => $state) {
            State::create($state);
        }
    }
}
