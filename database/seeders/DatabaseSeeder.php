<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Car::factory(10)->create();
        \App\Models\RentedCars::factory(10)->create();
        \App\Models\FuelConsumption::factory(10)->create();
        \App\Models\MaintenanceSchedule::factory(10)->create();
        \App\Models\UsageHistories::factory(10)->create();
        \App\Models\Employees::factory(10)->create();
        \App\Models\VehicleBookings::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
