<?php

namespace App\Helpers;

class GeoHelper
{
    // Haversine formula distance calculation
    public static function distance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));

        return $earthRadius * $c; // distance in km
    }

    // Point in polygon
    public static function pointInPolygon($point, $polygon)
    {
        $x = $point['lat'];
        $y = $point['lng'];

        $inside = false;
        $count = count($polygon);
        for ($i = 0, $j = $count - 1; $i < $count; $j = $i++) {
            $xi = $polygon[$i]['lat']; $yi = $polygon[$i]['lng'];
            $xj = $polygon[$j]['lat']; $yj = $polygon[$j]['lng'];

            $intersect = (($yi > $y) != ($yj > $y)) &&
                         ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);
            if ($intersect) $inside = !$inside;
        }

        return $inside;
    }
}
