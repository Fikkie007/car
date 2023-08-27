<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceSchedule;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMaintenanceScheduleRequest;
use App\Http\Requests\UpdateMaintenanceScheduleRequest;
use Illuminate\Http\Request;

class MaintenanceScheduleController extends Controller
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
            'maintenance_type' => 'required|string',
            'scheduled_date' => 'required|date',
            'completed' => 'required|boolean',
        ]);

        MaintenanceSchedule::create($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Maintenance Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceSchedule $maintenanceSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaintenanceSchedule $maintenanceSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaintenanceSchedule $maintenanceSchedule)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'maintenance_type' => 'required|string',
            'scheduled_date' => 'required|date',
            'completed' => 'required|boolean',
        ]);

        $maintenanceSchedule->update($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Maintenance Schedule updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceSchedule $maintenanceSchedule)
    {
        $maintenanceSchedule->delete();

        return redirect()->route('cars.show', $maintenanceSchedule['car_id'])->with('success', 'Maintenance Schedule deleted successfully.');
    }
}
