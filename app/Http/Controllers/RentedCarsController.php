<?php

namespace App\Http\Controllers;

use App\Models\RentedCars;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRentedCarsRequest;
use App\Http\Requests\UpdateRentedCarsRequest;
use App\Exports\RentedCarsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class RentedCarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date',
            'condition_at_return' => 'nullable|string',
        ]);

        RentedCars::create($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Rented Car created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(RentedCars $rentedCars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RentedCars $rentedCars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date',
            'condition_at_return' => 'nullable|string',
        ]);

        $rentedCar = RentedCars::findOrFail($id);
        $rentedCar->update($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Rented Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rentedCar = RentedCars::findOrFail($id);
        $rentedCar->delete();

        return redirect()->route('cars.show', $rentedCar['car_id'])->with('success', 'Rented Car deleted successfully.');
    }
}
