<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Ensure file is an image
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('resources', 'public');
        }

        // Create a new resource
        Resource::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath, // Assuming the instructor is the authenticated user
        ]);

        // Return a response
        return redirect()->route('pages.adminresource')->with('success', 'Plant added successfully.');
    }

    public function getResources()
    {
    $resources = Resource::all();
    return response()->json($resources);
    }

     // API method to fetch all plants
     public function apiIndex()
     {
         return response()->json(Resource::all());
     }
 
     public function index()
     {
         $resources = Resource::all();
         return response()->json($resources);
     }
 
     // Fetch a single resource
     public function show($id)
     {
         $resource = Resource::findOrFail($id);
         return response()->json($resource);
     }
 
     // Update a resource
     public function update(Request $request, $id)
     {
         $resource = Resource::findOrFail($id);
         $resource->title = $request->input('title');
         $resource->description = $request->input('description');
         
         if ($request->hasFile('image')) {
             $path = $request->file('image')->store('resources', 'public');
             $resource->image = $path;
         }
         
         if ($resource->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
     }
 
     // Delete a resource
     public function destroy($id)
     {
         $resource = Resource::findOrFail($id);
         $resource->delete();
         return response()->json(['success' => 'Plant deleted successfully']);
     }
    
}



