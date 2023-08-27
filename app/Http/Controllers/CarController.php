<?php

namespace App\Http\Controllers;

use App\Charts\FuelConsumptionChart;
use App\Exports\RentedCarsExport;
use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Employees;
use App\Models\FuelConsumption;
use App\Models\MaintenanceSchedule;
use App\Models\RentedCars;
use App\Models\UsageHistories;
use App\Models\VehicleBookings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        $latestReturnDate = RentedCars::getMaxReturnDates();
        $employeeRentReturn = VehicleBookings::getMaxReturnDates();
        return view('admin.home', compact('cars', 'latestReturnDate', 'employeeRentReturn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $car = new Car();
        $car->type = $request->input('type');
        $car->plate_number = $request->input('plate_number');
        $car->capacity = $request->input('capacity');
        $car->manufacturing_year = $request->input('manufacturing_year');
        $car->condition = $request->input('condition');
        $car->save();
        return redirect()->route('cars.index')->with('success', 'Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, FuelConsumptionChart $fuelChart)
    {
        $car = Car::findOrFail($id);
        $rents = RentedCars::where('car_id', $id)->get();
        $latestReturnDate = RentedCars::latestReturnDate($id);
        $employeeRentReturn = VehicleBookings::latestReturnDate($id);
        $fuelConsumptions = FuelConsumption::where('car_id', $id)->get();
        $serviceRecords = MaintenanceSchedule::where('car_id', $id)->get();
        $usageHistories = UsageHistories::where('car_id', $id)->get();
        $employeeRents = VehicleBookings::where('car_id', $id)->get();
        $employees = Employees::all();
        return view('admin.detail', compact('car', 'latestReturnDate', 'rents', 'fuelConsumptions', 'serviceRecords', 'usageHistories', 'employeeRents', 'employees', 'employeeRentReturn'), ['fuelChart' => $fuelChart->build($fuelConsumptions)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        $car->type = $request->input('type');
        $car->plate_number = $request->input('plate_number');
        $car->capacity = $request->input('capacity');
        $car->manufacturing_year = $request->input('manufacturing_year');
        $car->condition = $request->input('condition');
        $car->save();
        return redirect()->route('cars.index')->with('success', 'Data Pelanggan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the customer by ID
        $car = Car::findOrFail($id);
        $car->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('cars.index')->with('error', 'Pelanggan Berhasil Dihapus');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new RentedCarsExport, 'cars.xlsx');
    }
}
