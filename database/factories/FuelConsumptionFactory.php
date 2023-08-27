<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\RentedCars;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FuelConsumption>
 */
class FuelConsumptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicle = Car::inRandomOrder()->first();
        $rent = RentedCars::inRandomOrder()->first();
        return [
            'car_id' => $vehicle->id,
            'fuel_amount' => rand(20, 60),
            'distance' => rand(100, 500),
            'consumption' => rand(5, 15),
            'recorded_at' => Carbon::now()->subDays(rand(1, 365)),
        ];
    }
}
