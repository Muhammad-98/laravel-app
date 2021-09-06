<?php

namespace Database\Factories;

use App\Models\areas;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreasFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = areas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),

        ];
    }
}
