<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'latitude',
        'longitude',
        'status' // available, busy
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'assigned_delivery_man_id');
    }
}
