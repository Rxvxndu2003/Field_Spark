<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'care' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('plants', 'public');
        }

        Plant::create([
            'name' => $request->input('name'),
            'origin' => $request->input('origin'),
            'care' => $request->input('care'),
            'description' => $request->input('description'),
            'image' => $imagePath,
        ]);

        return redirect()->route('pages.instructorplant')->with('success', 'Plant added successfully.');
    }

    public function index()
    {
       $plants = Plant::all();
       return view('pages.plantinfo', compact('plants'));
    }
    public function show($id)
    {
       $plant = Plant::findOrFail($id);
       return view('pages.plantdetail', compact('plant'));
    }
    public function newPage()
    {
        $plants = Plant::all();
        return view('pages.plants', compact('plants'));
    }
    
    public function getPlants()
    {
    $plants = Plant::all();
    return response()->json($plants);
    }

    // API method to fetch all plants
    public function apiIndex()
    {
        return response()->json(Plant::all());
    }

    // Method to show the edit form for a specific plant
    public function edit($id)
    {
        $plant = Plant::findOrFail($id);
        return response()->json($plant);
    }

    // Method to update a specific plant
    public function update(Request $request, $id)
    {
    $plant = Plant::findOrFail($id);

    // Validate incoming request data if necessary
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'origin' => 'required|string|max:255',
        'care' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'image' => 'nullable|image|max:2048', // Ensure the image is valid
    ]);

    $plant->name = $validatedData['name'];
    $plant->origin = $validatedData['origin'];
    $plant->care = $validatedData['care'];
    $plant->description = $validatedData['description'];

    // Handle image upload if a new file is provided
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('plants', 'public');
        $plant->image = $imagePath;
    }

    $plant->save();

    return response()->json(['success' => 'Plant updated successfully']);
    }  
    // Method to delete a specific plant
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);
        $plant->delete();

        return response()->json(['success' => 'Plant deleted successfully']);
    }

}

