<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'delivery_zone_id',
        'assigned_delivery_man_id',
        'customer_name',
        'customer_phone',
        'delivery_address',
        'delivery_latitude',
        'delivery_longitude',
        'distance_km',
        'status',
        'total_amount'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

public function deliveryMan()
{
    return $this->belongsTo(DeliveryMan::class, 'assigned_delivery_man_id');
}

    public function deliveryZone()
    {
        return $this->belongsTo(DeliveryZone::class);
    }
}
