<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'radius_feet',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'radius_feet' => 'integer',
    ];

    const EARTH_RADIUS_FEET = 20902231;

    public function hasCoordinates(): bool
    {
        return ! is_null($this->latitude) && ! is_null($this->longitude);
    }

    public function distanceInFeetTo(float $lat, float $lng): float
    {
        $latFrom = deg2rad((float) $this->latitude);
        $lngFrom = deg2rad((float) $this->longitude);
        $latTo = deg2rad($lat);
        $lngTo = deg2rad($lng);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;

        $a = sin($latDelta / 2) ** 2 + cos($latFrom) * cos($latTo) * sin($lngDelta / 2) ** 2;
        $c = 2 * asin(min(1, sqrt($a)));

        return self::EARTH_RADIUS_FEET * $c;
    }

    public function isWithinRadius(float $lat, float $lng): bool
    {
        return $this->distanceInFeetTo($lat, $lng) <= $this->radius_feet;
    }
}
