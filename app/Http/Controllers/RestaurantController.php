<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;

class RestaurantController extends Controller
{
    // Show all restaurants
    public function index()
    {
        $restaurants = Restaurant::with(['deliveryZones', 'type'])->get();
        return view('restaurants.index', compact('restaurants'));
    }

    // Show create form
    public function create()
    {
        $types = Type::all();
        return view('restaurants.create', compact('types'));
    }

    // Store new restaurant
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'type_id' => 'nullable|exists:types,id',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    Restaurant::create($request->only(['name', 'type_id', 'latitude', 'longitude']));

    return redirect()->route('restaurants.index')->with('success', 'Restaurant added successfully!');
}

    // Edit form
    public function edit(Restaurant $restaurant)
    {
        $types = Type::all();
        return view('restaurants.edit', compact('restaurant','types'));
    }

    // Update restaurant
public function update(Request $request, Restaurant $restaurant)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'address'   => 'nullable|string|max:255',  // address nullable যদি সব restaurant এ না থাকে
        'latitude'  => 'required|numeric',
        'longitude' => 'required|numeric',
        'type_id'   => 'nullable|exists:types,id'
    ]);

    $restaurant->update($request->only(['name','address','latitude','longitude','type_id']));

    return redirect()->route('restaurants.index')->with('success','Restaurant updated successfully!');
}

    // Delete restaurant
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('success','Restaurant deleted successfully!');
    }
}
