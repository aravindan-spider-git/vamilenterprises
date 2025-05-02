<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::get();
        $companies = Company::all();
        return view('vehicles.index', compact('vehicles', 'companies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'registration_number' => 'required|unique:vehicles',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('vehicles', 'public');
        }
        Vehicle::create($validated);
        return redirect()->back()->with('success', 'Vehicle added successfully.');
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string',
            'registration_number' => 'required|unique:vehicles,registration_number,' . $vehicle->id,
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($vehicle->image) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $validated['image'] = $request->file('image')->store('vehicles', 'public');
        }
        $vehicle->update($validated);
        return redirect()->back()->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->image) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();
        return redirect()->back()->with('success', 'Vehicle deleted successfully.');
    }
}

