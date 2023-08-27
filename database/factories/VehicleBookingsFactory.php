<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Employees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleBookings>
 */
class VehicleBookingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employee = Employees::inRandomOrder()->first();
        $vehicle = Car::inRandomOrder()->first();
        $pickupDate = fake()->dateTimeBetween('now', '+1 month');
        $returnDate = fake()->dateTimeBetween($pickupDate, $pickupDate->format('Y-m-d H:i:s') . ' +1 week');
        return [
            'employee_id' => $employee->id,
            'car_id' => $vehicle->id,
            'booking_date' => now(),
            'pickup_date' => $pickupDate,
            'return_date' => $returnDate,
            'purpose' => fake()->sentence(),
            'approved' => fake()->boolean(),
            'authorized' => fake()->boolean()
        ];
    }
}
