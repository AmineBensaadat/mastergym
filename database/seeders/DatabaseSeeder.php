<?php

namespace Database\Seeders;

use App\Models\Files;
use App\Models\Gyms;
use App\Models\Members;
use App\Models\Services;
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
        //Gyms::factory(10)->create();
        //Files::factory(10)->create();
        //Services::factory(10)->create();
        //$this->call(GymTableSeeder::class);
        Members::factory(300)->create();
    }
}
