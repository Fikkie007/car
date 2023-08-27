<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsageHistories>
 */
class UsageHistoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rent = Car::inRandomOrder()->first();
        return [
            'car_id' => $rent->id,
            'distance' => rand(50, 300),
            'route' => 'Route information for usage ' . $rent->id,
            'destination' => 'Destination for usage ' . $rent->id
        ];
    }
}
