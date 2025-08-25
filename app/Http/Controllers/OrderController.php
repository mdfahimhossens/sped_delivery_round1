<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\DeliveryMan;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['restaurant', 'deliveryMan'])->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $restaurants = Restaurant::all();
        return view('orders.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_latitude' => 'required|numeric',
            'delivery_longitude' => 'required|numeric',
        ]);

        $restaurant = Restaurant::findOrFail($request->restaurant_id);

        // Assign first delivery zone
        $zone = $restaurant->deliveryZones()->first();
        if (!$zone) {
            return redirect()->back()->with('error', 'Restaurant has no delivery zones!');
        }

        $customerLat = $request->delivery_latitude;
        $customerLng = $request->delivery_longitude;

        // Validate delivery within zone
        $zoneData = json_decode($zone->data, true);
        $valid = false;
        if ($zone->type == 'radius') {
            $center = $zoneData['center'];
            $radius = $zoneData['radius'];
            $valid = $this->isWithinRadius($customerLat, $customerLng, $center['lat'], $center['lng'], $radius);
        } else {
            $polygon = $zoneData['coordinates'];
            $valid = $this->isPointInPolygon(['lat' => $customerLat, 'lng' => $customerLng], $polygon);
        }

        if (!$valid) {
            return redirect()->back()->with('error', 'Delivery address is outside the zone');
        }

        $distance = $this->calculateDistance($restaurant->latitude, $restaurant->longitude, $customerLat, $customerLng);

        $order = Order::create([
            'restaurant_id' => $restaurant->id,
            'delivery_zone_id' => $zone->id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'delivery_address' => $request->delivery_address,
            'delivery_latitude' => $customerLat,
            'delivery_longitude' => $customerLng,
            'distance_km' => round($distance, 2),
            'status' => 'pending',
            'total_amount' => $request->total_amount ?? 0,
        ]);

        
        // Assign nearest delivery man within 5 km
        $deliveryMen = DeliveryMan::where('status', 'available')->get();
        $nearest = null;
        $minDistance = 5;

        foreach ($deliveryMen as $man) {
            if ($man->latitude && $man->longitude) {
                $d = $this->calculateDistance($customerLat, $customerLng, $man->latitude, $man->longitude);
                if ($d <= $minDistance) {
                    $minDistance = $d;
                    $nearest = $man;
                }
            }
        }

        if ($nearest) {
            $order->assigned_delivery_man_id = $nearest->id;
            $order->status = 'assigned';
            $order->save();

            $nearest->status = 'busy';
            $nearest->save();
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully! Distance: ' . round($distance, 2) . ' km');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected,processing,delivered,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated to ' . ucfirst($request->status));
    }

    private function isWithinRadius($lat1, $lng1, $lat2, $lng2, $radiusInKm)
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) ** 2 +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return ($earthRadius * $c) <= $radiusInKm;
    }

    private function isPointInPolygon($point, $polygon)
    {
        $x = $point['lat'];
        $y = $point['lng'];
        $inside = false;
        for ($i = 0, $j = count($polygon) - 1; $i < count($polygon); $j = $i++) {
            $xi = $polygon[$i]['lat']; $yi = $polygon[$i]['lng'];
            $xj = $polygon[$j]['lat']; $yj = $polygon[$j]['lng'];
            $intersect = (($yi > $y) != ($yj > $y)) &&
                         ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) $inside = !$inside;
        }
        return $inside;
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) ** 2 +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }
}
