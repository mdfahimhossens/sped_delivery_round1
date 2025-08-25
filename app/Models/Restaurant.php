<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

protected $fillable = ['name', 'type_id', 'address', 'latitude', 'longitude'];


    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function deliveryZones()
    {
        return $this->hasMany(DeliveryZone::class);
    }
}
