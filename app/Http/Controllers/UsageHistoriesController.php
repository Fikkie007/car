<?php

namespace App\Http\Controllers;

use App\Models\UsageHistories;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsageHistoriesRequest;
use App\Http\Requests\UpdateUsageHistoriesRequest;
use Illuminate\Http\Request;

class UsageHistoriesController extends Controller
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
            'distance' => 'required|numeric',
            'route' => 'required|string',
            'destination' => 'required|string',
        ]);

        UsageHistories::create($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Usage History created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(UsageHistories $usageHistories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsageHistories $usageHistories)
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
            'distance' => 'required|numeric',
            'route' => 'required|string',
            'destination' => 'required|string',
        ]);
        $usageHistory = UsageHistories::findOrFail($id);
        $usageHistory->update($validatedData);

        return redirect()->route('cars.show', $validatedData['car_id'])->with('success', 'Usage History updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usageHistory = UsageHistories::findOrFail($id);
        $usageHistory->delete();

        return redirect()->back()->with('success', 'Usage History deleted successfully.');
    }
}
