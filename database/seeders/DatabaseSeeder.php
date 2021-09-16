<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        State::factory()
        ->count(1)
        ->create();   
        
        City::factory()
        ->count(1)
        ->create();

        Area::factory()
        ->count(1)
        ->create();
    }
}
