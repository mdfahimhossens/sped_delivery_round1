<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryZone extends Model
{
    use HasFactory;

        protected $fillable = [
        'restaurant_id',
        'type', // radius or polygon
        'data' // json containing center/radius or coordinates
    ];

    protected $casts = [
        'data' => 'array', // JSON string automatically array এ convert হবে
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

        public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
