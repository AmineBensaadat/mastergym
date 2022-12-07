<?php

namespace Database\Factories;

use App\Models\Gyms;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GymsFactory extends Factory
{
    /**
     * the name of yhe factory corresondin model
     * 
     * @var string
     */
    protected $model = Gyms::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'desc' => $this->faker->paragraph(),
            'address' => $this->faker->title(),
            'is_main' => $this->faker->boolean(),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}
