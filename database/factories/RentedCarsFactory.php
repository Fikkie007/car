<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentedCars>
 */
class RentedCarsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $vehicle = Car::inRandomOrder()->first();
        return [
            'car_id' => $vehicle->id,
            'rental_date' => now(),
            'return_date' => now()->addDay(rand(1, 30)),
        ];
    }
}
