<?php

namespace Tests\Unit;

use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Unit Tests for Flight Carbon Emission Calculation
 *
 * Tests the piecewise emission factor model across all duration ranges
 * and validates edge case handling.
 */
class FlightCarbonEmissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Short flight (< 1 hour) uses 120 kg CO₂/hour factor
     */
    public function test_short_flight_emission_less_than_one_hour()
    {
        $flight = $this->createFlightWithDuration(0.5); // 30 minutes

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 0.5 hours × 120 kg/hour = 60 kg
        $this->assertEquals(60.0, $emission);
    }

    /**
     * Test: Regional flight (1-3 hours) uses 100 kg CO₂/hour factor
     */
    public function test_regional_flight_emission_one_hour()
    {
        $flight = $this->createFlightWithDuration(1.0);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 1 hour × 100 kg/hour = 100 kg
        $this->assertEquals(100.0, $emission);
    }

    /**
     * Test: Regional flight at 3 hours boundary (still 100 kg/hour)
     */
    public function test_regional_flight_emission_three_hours()
    {
        $flight = $this->createFlightWithDuration(3.0);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 3 hours × 100 kg/hour = 300 kg
        $this->assertEquals(300.0, $emission);
    }

    /**
     * Test: Medium-haul flight (3-6 hours) uses 90 kg CO₂/hour factor
     */
    public function test_medium_haul_flight_emission_four_hours()
    {
        $flight = $this->createFlightWithDuration(4.0);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 4 hours × 90 kg/hour = 360 kg
        $this->assertEquals(360.0, $emission);
    }

    /**
     * Test: Medium-haul flight at 6 hours boundary (still 90 kg/hour)
     */
    public function test_medium_haul_flight_emission_six_hours()
    {
        $flight = $this->createFlightWithDuration(6.0);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 6 hours × 90 kg/hour = 540 kg
        $this->assertEquals(540.0, $emission);
    }

    /**
     * Test: Long-haul flight (6+ hours) uses 80 kg CO₂/hour factor
     */
    public function test_long_haul_flight_emission_eight_hours()
    {
        $flight = $this->createFlightWithDuration(8.0);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 8 hours × 80 kg/hour = 640 kg
        $this->assertEquals(640.0, $emission);
    }

    /**
     * Test: Very long flight (12+ hours)
     */
    public function test_ultra_long_haul_flight_emission()
    {
        $flight = $this->createFlightWithDuration(12.0);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 12 hours × 80 kg/hour = 960 kg
        $this->assertEquals(960.0, $emission);
    }

    /**
     * Test: Decimal duration (2.5 hours in regional range)
     */
    public function test_decimal_duration_flight()
    {
        $flight = $this->createFlightWithDuration(2.5);

        $emission = $flight->calculateCarbonEmissions();

        // Expected: 2.5 hours × 100 kg/hour = 250 kg
        $this->assertEquals(250.0, $emission);
    }

    /**
     * Test: Edge case - zero duration returns 0
     */
    public function test_zero_duration_returns_zero()
    {
        $flight = $this->createFlightWithDuration(0.0);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(0.0, $emission);
    }

    /**
     * Test: Edge case - missing departure time returns 0
     */
    public function test_missing_departure_time_returns_zero()
    {
        $flight = Flight::factory()->create([
            'departure_time' => null,
            'arrival_time' => now()->addHours(2),
        ]);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(0.0, $emission);
    }

    /**
     * Test: Edge case - missing arrival time returns 0
     */
    public function test_missing_arrival_time_returns_zero()
    {
        $flight = Flight::factory()->create([
            'departure_time' => now(),
            'arrival_time' => null,
        ]);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(0.0, $emission);
    }

    /**
     * Test: Edge case - arrival before departure returns 0
     */
    public function test_arrival_before_departure_returns_zero()
    {
        $departure = now();
        $arrival = $departure->clone()->subHours(1);

        $flight = Flight::factory()->create([
            'departure_time' => $departure,
            'arrival_time' => $arrival,
        ]);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(0.0, $emission);
    }

    /**
     * Test: Rounding to 1 decimal place
     */
    public function test_emission_rounded_to_one_decimal()
    {
        // 1.33 hours × 100 kg/hour = 133.333...
        $flight = $this->createFlightWithDuration(1.333333);

        $emission = $flight->calculateCarbonEmissions();

        // Should round to 1 decimal: 133.3
        $this->assertEquals(133.3, $emission);
        $this->assertIsFloat($emission);
    }

    /**
     * Test: Realistic domestic flight scenario
     * Jakarta to Surabaya (~2 hours)
     */
    public function test_realistic_jakarta_surabaya_flight()
    {
        $flight = $this->createFlightWithDuration(2.0);

        $emission = $flight->calculateCarbonEmissions();

        // 2 hours × 100 kg/hour = 200 kg
        $this->assertEquals(200.0, $emission);
    }

    /**
     * Test: Realistic international flight scenario
     * Jakarta to Singapore (~1.5 hours)
     */
    public function test_realistic_jakarta_singapore_flight()
    {
        $flight = $this->createFlightWithDuration(1.5);

        $emission = $flight->calculateCarbonEmissions();

        // 1.5 hours × 100 kg/hour = 150 kg
        $this->assertEquals(150.0, $emission);
    }

    /**
     * Test: Realistic long-haul flight scenario
     * Jakarta to Tokyo (~7 hours)
     */
    public function test_realistic_jakarta_tokyo_flight()
    {
        $flight = $this->createFlightWithDuration(7.0);

        $emission = $flight->calculateCarbonEmissions();

        // 7 hours × 80 kg/hour = 560 kg
        $this->assertEquals(560.0, $emission);
    }

    /**
     * Helper method: Create flight with specific duration in hours
     *
     * @param float $durationHours Duration in decimal hours
     * @return Flight
     */
    private function createFlightWithDuration($durationHours)
    {
        $departure = now();
        $arrival = $departure->clone()->addMinutes(intval($durationHours * 60));

        return Flight::factory()->create([
            'departure_time' => $departure,
            'arrival_time' => $arrival,
        ]);
    }
}
