<?php

namespace Database\Factories;

use App\Models\Files;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FilesFactory extends Factory
{
    /**
     * the name of yhe factory corresondin model
     * 
     * @var string
     */
    protected $model = Files::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'entitiy_id' => $this->faker->randomDigit(),
            'name' => "gym1",
            'type' => "profile",
            'ext' => "jpg"
        ];
    }
}
