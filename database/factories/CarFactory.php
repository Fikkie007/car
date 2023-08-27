<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $this->faker->addProvider(new Fakecar($this->faker));
        $vehicle = $this->faker->vehicleArray();
        return [
            'type' => $vehicle['brand'],
            'plate_number' =>  $this->faker->vehicleRegistration,
            'capacity' => $this->faker->vehicleSeatCount,
            'manufacturing_year' => $this->faker->biasedNumberBetween(1990, date('Y'), 'sqrt'),
        ];
    }
}
