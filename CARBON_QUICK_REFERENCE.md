# Carbon Emission Calculation - Quick Reference

## TL;DR

Use `$flight->calculateCarbonEmissions()` to get CO₂ emissions per passenger in kg.

**Returns:** `float` rounded to 1 decimal place

## Piecewise Model at a Glance

```
Duration        Factor    Example Calculation
─────────────────────────────────────────────────────────
< 1 hour        120/hr    30 min flight = 0.5 × 120 = 60 kg
1-3 hours       100/hr    2 hour flight  = 2.0 × 100 = 200 kg
3-6 hours       90/hr     4 hour flight  = 4.0 × 90 = 360 kg
6+ hours        80/hr     8 hour flight  = 8.0 × 80 = 640 kg
```

## Usage

### In Controller
```php
public function show(Flight $flight)
{
    return view('flights.show', [
        'flight' => $flight,
        'carbonEmission' => $flight->calculateCarbonEmissions(),
    ]);
}
```

### In Blade Template
```blade
<span>Emisi Karbon: {{ $flight->calculateCarbonEmissions() }} kg CO₂</span>
```

### In Query
```php
$flights = Flight::all()->map(function ($flight) {
    return [
        'flight' => $flight,
        'emission' => $flight->calculateCarbonEmissions(),
    ];
});
```

## Common Scenarios

| Route | Duration | Calculation | Emission |
|-------|----------|-------------|----------|
| Jakarta → Bandung | 0.5 hr | 0.5 × 120 | **60.0 kg** |
| Jakarta → Yogyakarta | 1.5 hr | 1.5 × 100 | **150.0 kg** |
| Jakarta → Surabaya | 2.0 hr | 2.0 × 100 | **200.0 kg** |
| Jakarta → Singapore | 1.5 hr | 1.5 × 100 | **150.0 kg** |
| Jakarta → Bali | 4.0 hr | 4.0 × 90 | **360.0 kg** |
| Jakarta → Tokyo | 7.0 hr | 7.0 × 80 | **560.0 kg** |
| Jakarta → London | 13.0 hr | 13.0 × 80 | **1040.0 kg** |

## Edge Cases (All return 0.0)

```php
// Missing timestamps
$flight->departure_time = null;
$flight->calculateCarbonEmissions(); // Returns: 0.0

// Arrival before departure
$flight->departure_time = '2026-01-10 10:00:00';
$flight->arrival_time = '2026-01-10 09:00:00';
$flight->calculateCarbonEmissions(); // Returns: 0.0

// Zero duration
$flight->departure_time = $flight->arrival_time;
$flight->calculateCarbonEmissions(); // Returns: 0.0
```

## Testing

Run tests with:
```bash
php artisan test tests/Unit/FlightCarbonEmissionTest.php
```

16 tests covering:
- ✅ All duration ranges
- ✅ Boundary conditions
- ✅ Decimal durations
- ✅ Edge cases
- ✅ Realistic scenarios

## Documentation

See full guide: `CARBON_EMISSION_GUIDE.md`
