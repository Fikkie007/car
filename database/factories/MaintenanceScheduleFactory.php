<?php

namespace Database\Factories;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceSchedule>
 */
class MaintenanceScheduleFactory extends Factory
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
            'maintenance_type' => 'Oil Change',
            'scheduled_date' => Carbon::now()->addDays(1 * 30),

        ];
    }
}
