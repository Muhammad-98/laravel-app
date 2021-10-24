<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street' => $this->faker->streetName(),
            'building' => $this->faker->buildingNumber(),
            'floor' => $this->faker->randomDigit(),
            'apartment' => $this->faker->randomDigit(),
            'landmark' => $this->faker->name(),
            'area_id' => Area::inRandomOrder()->value('id')
        ];
    }
}
