<?php

namespace Database\Seeders;

use App\Models\Files;
use App\Models\Gyms;
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
        Gyms::factory(10)->create();
        Files::factory(10)->create();
        //$this->call(GymTableSeeder::class);
    }
}
