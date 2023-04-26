<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedRegions();
    }

    private function seedRegions(): void
    {
        $countries = Country::factory()->count(5)->create();

        /** @var Country $country*/
        foreach ($countries as $country)
        {
            City::factory()->count(5)->create(['country_id' => $country->id]);
        }
    }
}
