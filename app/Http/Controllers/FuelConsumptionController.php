<?php

namespace App\Http\Controllers;

use App\Models\FuelConsumption;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFuelConsumptionRequest;
use App\Http\Requests\UpdateFuelConsumptionRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class FuelConsumptionController extends Controller
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
            'fuel_amount' => 'required|numeric',
            'distance' => 'required|numeric',
            'consumption' => 'required|numeric',
            'recorded_at' => 'nullable|date',
        ]);

        if (!$validatedData['recorded_at']) {
            $validatedData['recorded_at'] = now();
        }

        FuelConsumption::create($validatedData);

        return redirect()->route('fuels.show', $validatedData['car_id'])->with('success', 'Fuel Consumption recorded successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fuels = FuelConsumption::where('car_id', $id)->get();
        $car = Car::findOrFail($id);
        return view('admin.fuel', compact('fuels', 'car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FuelConsumption $fuelConsumption)
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
            'fuel_amount' => 'required|numeric',
            'distance' => 'required|numeric',
            'consumption' => 'required|numeric',
            'recorded_at' => 'nullable|date',
        ]);

        if (!$validatedData['recorded_at']) {
            $validatedData['recorded_at'] = now();
        }

        $fuelConsumption = FuelConsumption::findOrFail($id);
        $fuelConsumption->update($validatedData);

        return redirect()->route('fuels.show', $validatedData['car_id'])->with('success', 'Rented Car updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fuel = FuelConsumption::findOrFail($id);
        $fuel->delete();

        return redirect()->route('fuels.show', $fuel['car_id'])->with('success', 'Fuel Consumption deleted successfully.');
    }
}
