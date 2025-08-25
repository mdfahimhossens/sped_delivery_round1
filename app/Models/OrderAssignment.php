<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'delivery_man_id', 'status'];

    public function deliveryMan()
    {
        return $this->belongsTo(DeliveryMan::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
