<?php

namespace Database\Factories;

use App\Models\Members;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MembersFactory extends Factory
{
    /**
     * the name of yhe factory corresondin model
     * 
     * @var string
     */
    protected $model = Members::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'DOB' => $this->faker->date('Y_m_d'),
            'email' => $this->faker->unique()->email(),
            'address' => $this->faker->address(),
            'status' => $this->faker->boolean(),
            'gender' =>  $this->faker->asciify('male'),
            'phone' => $this->faker->phoneNumber(),
            'emergency_contact' => $this->faker->phoneNumber(),
            'health_issues' =>  $this->faker->asciify('no issue'),
            'source' =>  $this->faker->asciify('no one'),
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
}
