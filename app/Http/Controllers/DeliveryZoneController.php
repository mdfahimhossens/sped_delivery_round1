<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryZone;
use App\Models\Restaurant;

class DeliveryZoneController extends Controller
{
    public function index(){
        $zones = DeliveryZone::with('restaurant')->get();
        return view('delivery_zones.index', compact('zones'));
    }

    public function create($restaurantId){
        $restaurant = Restaurant::findOrFail($restaurantId);
        return view('delivery_zones.create', compact('restaurant'));
    }

public function store(Request $request){
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'type' => 'required|in:radius,polygon',
            'data' => 'required|json'
        ]);

        DeliveryZone::create([
            'restaurant_id' => $request->restaurant_id,
            'type' => $request->type,
            'data' => $request->data
        ]);

        return redirect()->route('restaurants.index')->with('success','Delivery zone added!');
    }

    public function edit(DeliveryZone $zone){
        $restaurants = Restaurant::all();
        return view('delivery_zones.edit', compact('zone','restaurants'));
    }

    public function update(Request $request, DeliveryZone $zone){
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'type' => 'required|in:polygon,radius',
            'data' => 'required|json'
        ]);

        $zone->update($request->all());
        return redirect('/delivery-zones')->with('success','Delivery Zone updated!');
    }

    public function destroy(DeliveryZone $zone){
        $zone->delete();
        return redirect('/delivery-zones')->with('success','Delivery Zone deleted!');
    }
}
