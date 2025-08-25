<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryMan;
use App\Models\Order;

class DeliveryManController extends Controller
{
public function index()
{
    $orders = Order::with(['restaurant', 'deliveryMan'])->get(); // ✅ deliveryMan relation include
    return view('orders.index', compact('orders'));
}

    public function create() {
        return view('delivery_men.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:available,busy,inactive',
        ]);

        DeliveryMan::create($request->only('name','phone','status'));

        return redirect()->route('delivery-men.index')->with('success','Delivery man added!');
    }

    public function edit($id) {
        $deliveryMan = DeliveryMan::findOrFail($id);
        return view('delivery_men.edit', compact('deliveryMan'));
    }

    public function update(Request $request, $id) {
        $deliveryMan = DeliveryMan::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:available,busy,inactive',
        ]);

        $deliveryMan->update($request->only('name','phone','status'));

        return redirect()->route('delivery-men.index')->with('success','Delivery man updated!');
    }

    public function destroy($id) {
        $deliveryMan = DeliveryMan::findOrFail($id);
        $deliveryMan->delete();
        return redirect()->route('delivery-men.index')->with('success','Delivery man deleted!');
    }
}
