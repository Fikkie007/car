<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\FuelConsumptionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MaintenanceScheduleController;
use App\Http\Controllers\RentedCarsController;
use App\Http\Controllers\UsageHistoriesController;
use App\Http\Controllers\VehicleBookingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::resource('cars', CarController::class);
    Route::get('/cars/export', [CarController::class, 'export'])->name('cars.export');

    Route::resource('rentCars', RentedCarsController::class);
    Route::get('/exports/{id}', [RentedCarsController::class, 'export'])->name('export.rented_cars');

    Route::resource('fuels', FuelConsumptionController::class);
    Route::resource('maintenanceSchedules', MaintenanceScheduleController::class);
    Route::resource('usages', UsageHistoriesController::class);
    Route::resource('employeeRents', VehicleBookingsController::class);
});
