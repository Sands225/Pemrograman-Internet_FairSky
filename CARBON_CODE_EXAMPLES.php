<?php

/**
 * CARBON EMISSION CALCULATION - CODE EXAMPLES
 *
 * Production-ready examples for integrating carbon emissions
 * into your flight booking application.
 */

// ============================================================================
// EXAMPLE 1: Display in Flight Search Results (Blade Template)
// ============================================================================

/*
@foreach($flights as $flight)
    @php
        $carbonEmission = $flight->calculateCarbonEmissions();
        $emissionCategory = match(true) {
            $carbonEmission < 100 => 'bg-green-100 text-green-700',
            $carbonEmission < 300 => 'bg-blue-100 text-blue-700',
            $carbonEmission < 500 => 'bg-yellow-100 text-yellow-700',
            default => 'bg-red-100 text-red-700'
        };
    @endphp

    <div class="flight-card">
        <div class="flight-info">
            <!-- Flight details -->
        </div>
        <div class="carbon-badge {{ $emissionCategory }}">
            {{ $carbonEmission }} kg CO₂
        </div>
    </div>
@endforeach
*/

// ============================================================================
// EXAMPLE 2: Controller Method for Flight Display
// ============================================================================

/*
namespace App\Http\Controllers;

use App\Models\Flight;

class FlightController extends Controller
{
    public function showFlightDetails(Flight $flight)
    {
        return view('flights.show', [
            'flight' => $flight,
            'carbonEmission' => $flight->calculateCarbonEmissions(),
            'emissionComparison' => $this->getEmissionComparison($flight),
        ]);
    }

    /**
     * Calculate emission reduction if user chooses a greener option
     * /
    private function getEmissionComparison(Flight $flight)
    {
        $baseEmission = $flight->calculateCarbonEmissions();

        // Find comparable flights (same route, within 2 hours)
        $comparable = Flight::where('origin_airport_id', $flight->origin_airport_id)
            ->where('destination_airport_id', $flight->destination_airport_id)
            ->get()
            ->map(function ($f) {
                return [
                    'flight' => $f,
                    'emission' => $f->calculateCarbonEmissions(),
                ];
            });

        $greenestOption = $comparable->sortBy('emission')->first();

        return [
            'currentEmission' => $baseEmission,
            'greenestEmission' => $greenestOption['emission'] ?? null,
            'reduction' => $baseEmission - ($greenestOption['emission'] ?? 0),
            'reductionPercent' => $greenestOption
                ? round((1 - $greenestOption['emission'] / $baseEmission) * 100, 1)
                : 0,
        ];
    }
}
*/

// ============================================================================
// EXAMPLE 3: JSON API Response with Emissions
// ============================================================================

/*
public function getFlightsJson(Request $request)
{
    $flights = Flight::with(['airline', 'originAirport', 'destinationAirport'])
        ->paginate(10);

    return response()->json([
        'data' => $flights->map(function ($flight) {
            return [
                'id' => $flight->id,
                'flightNumber' => $flight->flight_number,
                'airline' => $flight->airline->airline_name,
                'route' => $flight->originAirport->airport_code . ' → ' .
                          $flight->destinationAirport->airport_code,
                'departure' => $flight->departure_time,
                'arrival' => $flight->arrival_time,
                'duration' => $this->calculateDuration($flight),
                'carbonEmission' => $flight->calculateCarbonEmissions(),
                'pricePerPassenger' => $flight->flightClasses->first()->price ?? 0,
            ];
        }),
        'pagination' => [
            'total' => $flights->total(),
            'perPage' => $flights->perPage(),
            'currentPage' => $flights->currentPage(),
        ],
    ]);
}

private function calculateDuration(Flight $flight)
{
    $departure = \Carbon\Carbon::parse($flight->departure_time);
    $arrival = \Carbon\Carbon::parse($flight->arrival_time);
    return $arrival->diffForHumans($departure, ['parts' => 2]);
}
*/

// ============================================================================
// EXAMPLE 4: Sorting Flights by Carbon Emissions
// ============================================================================

/*
public function searchFlights(Request $request)
{
    $flights = Flight::query()
        ->where('origin_airport_id', $request->origin_id)
        ->where('destination_airport_id', $request->destination_id)
        ->get();

    // Add carbon emissions to each flight
    $flights = $flights->map(function ($flight) {
        $flight->carbon_emission = $flight->calculateCarbonEmissions();
        return $flight;
    });

    // Sort by requested criteria
    switch ($request->sortBy) {
        case 'greenest':
            $flights = $flights->sortBy('carbon_emission');
            break;
        case 'cheapest':
            $flights = $flights->sortBy(function ($f) {
                return $f->flightClasses->first()->price ?? PHP_INT_MAX;
            });
            break;
        case 'fastest':
            $flights = $flights->sortBy(function ($f) {
                return \Carbon\Carbon::parse($f->departure_time)
                    ->diffInMinutes($f->arrival_time);
            });
            break;
        default:
            // Balanced score: price + duration + emissions
            $flights = $flights->sortBy(function ($f) {
                $price = $f->flightClasses->first()->price ?? 0;
                $duration = \Carbon\Carbon::parse($f->departure_time)
                    ->diffInHours($f->arrival_time);
                $emission = $f->carbon_emission;

                // Normalize and combine scores
                return ($price / 1000) + ($duration * 10) + ($emission / 10);
            });
    }

    return view('flights.results', ['flights' => $flights]);
}
*/

// ============================================================================
// EXAMPLE 5: Saving Carbon Footprint in Booking
// ============================================================================

/*
namespace App\Models;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
        'flight_class_id',
        'passenger_name',
        'passenger_phone',
        'status',
        'payment_status',
        'total_price',
        'booking_date',
        'carbon_offset_kg', // NEW FIELD
    ];

    public static function createFromFlight(Flight $flight, FlightClass $flightClass, User $user, array $data)
    {
        return static::create([
            'user_id' => $user->id,
            'flight_id' => $flight->id,
            'flight_class_id' => $flightClass->id,
            'passenger_name' => $data['name'],
            'passenger_phone' => $data['phone'],
            'status' => 'confirmed',
            'payment_status' => 'pending',
            'total_price' => $flightClass->price,
            'booking_date' => now(),
            'carbon_offset_kg' => $flight->calculateCarbonEmissions(),
        ]);
    }
}

// In migration (add to create_bookings_table):
/*
$table->decimal('carbon_offset_kg', 8, 2)->nullable()->comment('CO2e per passenger');
*/
*/

// ============================================================================
// EXAMPLE 6: Display Carbon Impact Information to User
// ============================================================================

/*
<div class="carbon-impact-info">
    <h3>🌍 Environmental Impact</h3>

    @php
        $emission = $flight->calculateCarbonEmissions();
        // Tree equivalents: ~21 kg CO2 per tree per year
        $treeEquivalents = round($emission / 21, 1);
        // Car miles: ~0.41 kg CO2 per mile
        $carMiles = round($emission / 0.41, 0);
    @endphp

    <div class="impact-metrics">
        <div class="metric">
            <span class="label">CO₂ Emissions:</span>
            <span class="value">{{ $emission }} kg</span>
        </div>
        <div class="metric">
            <span class="label">Equivalent to:</span>
            <span class="value">{{ $treeEquivalents }} trees/year</span>
        </div>
        <div class="metric">
            <span class="label">Or driving:</span>
            <span class="value">{{ $carMiles }} miles</span>
        </div>
    </div>

    <div class="carbon-offset-option">
        <input type="checkbox" name="offset_carbon" value="1">
        <label>
            Offset this flight for $
            @php
                // $15 per ton of CO2
                echo round($emission / 1000 * 15, 2);
            @endphp
        </label>
    </div>
</div>
*/

// ============================================================================
// EXAMPLE 7: Unit Testing Template
// ============================================================================

/*
namespace Tests\Unit;

use App\Models\Flight;
use Tests\TestCase;

class CarbonEmissionTest extends TestCase
{
    public function test_short_flight_under_one_hour()
    {
        // 30 minute flight
        $flight = Flight::factory()->create([
            'departure_time' => now(),
            'arrival_time' => now()->addMinutes(30),
        ]);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(60.0, $emission); // 0.5 × 120
    }

    public function test_regional_flight_2_hours()
    {
        // 2 hour flight
        $flight = Flight::factory()->create([
            'departure_time' => now(),
            'arrival_time' => now()->addHours(2),
        ]);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(200.0, $emission); // 2.0 × 100
    }

    public function test_edge_case_invalid_times()
    {
        $flight = Flight::factory()->create([
            'departure_time' => now(),
            'arrival_time' => now()->subHours(1), // Before departure
        ]);

        $emission = $flight->calculateCarbonEmissions();

        $this->assertEquals(0.0, $emission);
    }
}
*/

// ============================================================================
// EXAMPLE 8: Advanced: Bulk Processing Flights
// ============================================================================

/*
namespace App\Jobs;

use App\Models\Flight;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CalculateFlightEmissions implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle()
    {
        Flight::chunk(100, function ($flights) {
            foreach ($flights as $flight) {
                // Calculate and potentially cache or store
                $emission = $flight->calculateCarbonEmissions();

                // Optionally store in cache for faster retrieval
                cache()->put(
                    "flight_{$flight->id}_emission",
                    $emission,
                    now()->addDay()
                );
            }
        });
    }
}

// Dispatch: CalculateFlightEmissions::dispatch();
*/

// ============================================================================
// QUICK EMISSION REFERENCE
// ============================================================================

// Domestic flight (1.5 hours)
// $emission = $flight->calculateCarbonEmissions(); // Result: 150.0

// Regional flight (2 hours)
// $emission = $flight->calculateCarbonEmissions(); // Result: 200.0

// Medium-haul (4 hours)
// $emission = $flight->calculateCarbonEmissions(); // Result: 360.0

// Long-haul (8 hours)
// $emission = $flight->calculateCarbonEmissions(); // Result: 640.0
