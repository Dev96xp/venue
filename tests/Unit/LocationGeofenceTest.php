<?php

namespace Tests\Unit;

use App\Models\Location;
use PHPUnit\Framework\TestCase;

class LocationGeofenceTest extends TestCase
{
    public function test_has_coordinates_is_false_without_lat_lng(): void
    {
        $location = new Location(['radius_feet' => 100]);

        $this->assertFalse($location->hasCoordinates());
    }

    public function test_has_coordinates_is_true_with_lat_lng(): void
    {
        $location = new Location(['latitude' => 25.7617, 'longitude' => -80.1918, 'radius_feet' => 100]);

        $this->assertTrue($location->hasCoordinates());
    }

    public function test_distance_is_zero_at_the_same_point(): void
    {
        $location = new Location(['latitude' => 25.7617, 'longitude' => -80.1918, 'radius_feet' => 100]);

        $this->assertEqualsWithDelta(0, $location->distanceInFeetTo(25.7617, -80.1918), 0.01);
    }

    public function test_is_within_radius_when_point_is_close(): void
    {
        $location = new Location(['latitude' => 25.7617, 'longitude' => -80.1918, 'radius_feet' => 300]);

        // ~0.0003 degrees latitude is roughly 110 feet
        $this->assertTrue($location->isWithinRadius(25.76173, -80.1918));
    }

    public function test_is_within_radius_is_false_when_point_is_far(): void
    {
        $location = new Location(['latitude' => 25.7617, 'longitude' => -80.1918, 'radius_feet' => 100]);

        $this->assertFalse($location->isWithinRadius(25.7717, -80.2018));
    }
}
