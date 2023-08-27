<?php

namespace App\Http\Controllers;

use App\Models\VehicleBookings;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleBookingsRequest;
use App\Http\Requests\UpdateVehicleBookingsRequest;
use Illuminate\Http\Request;

class VehicleBookingsController extends Controller
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
            'employee_id' => 'required|exists:employees,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'booking_date' => 'required|date',
            'return_date' => 'required|date',
            'purpose' => 'required|string',
        ]);

        VehicleBookings::create($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Vehicle Booking created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(VehicleBookings $vehicleBookings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VehicleBookings $vehicleBookings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'car_id' => 'required|exists:cars,id',
            'pickup_date' => 'required|date',
            'return_date' => 'required|date',
            'booking_date' => 'required|date',
            'purpose' => 'required|string',
            'approved' => 'required|boolean',
            'authorized' => 'required|boolean'
        ]);

        $vehicleBooking = VehicleBookings::findOrFail($id);
        $vehicleBooking->update($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Vehicle Booking updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehicleBooking = VehicleBookings::findOrFail($id);
        $vehicleBooking->delete();

        return redirect()->back()->with('success', 'Vehicle Booking deleted successfully.');
    }
}
