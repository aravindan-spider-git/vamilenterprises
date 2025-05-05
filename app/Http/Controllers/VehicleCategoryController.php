<?php

namespace App\Http\Controllers;

use App\Models\VehicleCategory;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    public function index()
    {
        $categories = VehicleCategory::all();
        return view('vehicles.categories', compact('categories'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.categories', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:vehicle_categories,name',
        ]);

        VehicleCategory::create($request->all());

        return redirect()->route('vehicle-categories.index')->with('success', 'Category created.');
    }

    public function show(VehicleCategory $vehicleCategory)
    {
        return view('vehicles.categories', compact('vehicleCategory'));
    }

    public function edit(VehicleCategory $vehicleCategory)
    {
        $vehicles = Vehicle::all();
        return view('vehicles.categories', compact('vehicleCategory', 'vehicles'));
    }

    public function update(Request $request, VehicleCategory $vehicleCategory)
    {
        $request->validate([
            'name' => 'required|unique:vehicle_categories,name,' . $vehicleCategory->id,
        ]);

        $vehicleCategory->update($request->all());

        return redirect()->route('vehicle-categories.index')->with('success', 'Category updated.');
    }

    public function destroy(VehicleCategory $vehicleCategory)
    {
        $vehicleCategory->delete();

        return redirect()->route('vehicle-categories.index')->with('success', 'Category deleted.');
    }
}

