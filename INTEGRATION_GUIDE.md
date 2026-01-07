# Integration Guide: Update Flight Search Results View

## Current State vs. Updated State

### BEFORE (Hardcoded Carbon)
```blade
<span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-[10px] px-2 py-1 rounded-md font-medium border border-green-100">
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    Info Karbon: 120 kg CO2e  <!-- HARDCODED -->
</span>
```

### AFTER (Dynamic Carbon Calculation)
```blade
@php
    $carbonEmissions = $flight->calculateCarbonEmissions();
@endphp
<span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-[10px] px-2 py-1 rounded-md font-medium border border-green-100">
    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
    Info Karbon: {{ $carbonEmissions }} kg CO2e  <!-- DYNAMIC -->
</span>
```

## Example Output in Different Routes

### Route 1: Jakarta → Bandung (30 minutes)
```
Durasi: 30 min = 0.5 hours
Faktor: 120 kg CO₂/hour
Hasil: 0.5 × 120 = 60.0 kg CO2e
```

### Route 2: Jakarta → Surabaya (2 hours)
```
Durasi: 2 hours
Faktor: 100 kg CO₂/hour (1-3 range)
Hasil: 2.0 × 100 = 200.0 kg CO2e
```

### Route 3: Jakarta → Bali (4 hours)
```
Durasi: 4 hours
Faktor: 90 kg CO₂/hour (3-6 range)
Hasil: 4.0 × 90 = 360.0 kg CO2e
```

### Route 4: Jakarta → Tokyo (7 hours)
```
Durasi: 7 hours
Faktor: 80 kg CO₂/hour (6+ range)
Hasil: 7.0 × 80 = 560.0 kg CO2e
```

## Current Implementation Status

✅ **Flight Model** - `calculateCarbonEmissions()` method added
✅ **View Updated** - `resources/views/flights/index.blade.php` updated to use dynamic calculation
✅ **Tests Created** - 16 comprehensive unit tests
✅ **Documentation** - Complete with examples and guides

## How the Calculation Works

```
User visits search results page
            ↓
Laravel loads flights from database with timestamps
            ↓
Template calls: $flight->calculateCarbonEmissions()
            ↓
Method calculates duration from departure_time and arrival_time
            ↓
Piecewise logic applies correct emission factor:
  • < 1 hour   → 120 kg CO₂/hour
  • 1-3 hours  → 100 kg CO₂/hour
  • 3-6 hours  → 90 kg CO₂/hour
  • 6+ hours   → 80 kg CO₂/hour
            ↓
Returns: duration × factor (rounded to 1 decimal)
            ↓
Display in flight card: "Info Karbon: XXX.X kg CO2e"
```

## What Users See

For each flight in search results, they now see:

```
┌─────────────────────────────────────┐
│ Garuda Indonesia               |    │
│ Boeing 737                     |    │
├─────────────────────────────────────┤
│                                     │
│ 08:00 JKT     ──────►  12:00 SBY   │
│  Jakarta              Surabaya      │
│                                     │
│ ✓ Info Karbon: 200.0 kg CO2e ◄──┐  │
│                                 │  │
│ 2.0 jam durasi × 100 faktor = 200  │
│                                     │
│ Harga: IDR 1,500,000 │   [Pilih]  │
└─────────────────────────────────────┘
```

## Testing the Implementation

### 1. Manual Testing in Browser

1. Go to flight search page
2. Select any route (e.g., Jakarta to Surabaya)
3. Check the displayed carbon emissions
4. Compare with duration:
   - 30 min flight → should show ~60 kg
   - 2 hour flight → should show ~200 kg
   - 4 hour flight → should show ~360 kg

### 2. Running Unit Tests

```bash
php artisan test tests/Unit/FlightCarbonEmissionTest.php
```

Expected: 16/16 tests passing ✅

### 3. Verifying Database

```bash
php artisan tinker
```

```php
$flight = Flight::find(1);
$emission = $flight->calculateCarbonEmissions();
dd($emission); // Will show the calculated emission

// Test edge cases
$flight->departure_time = null;
$emission = $flight->calculateCarbonEmissions(); // Should return 0.0
```

## Performance Impact

✅ **Minimal** - Calculation is O(1) with no database queries
✅ **Fast** - Executes in microseconds
✅ **Cacheable** - Can be cached per flight if needed

## Files Involved

### Modified
- `app/Models/Flight.php` - Core implementation
- `resources/views/flights/index.blade.php` - Display integration

### Created
- `tests/Unit/FlightCarbonEmissionTest.php` - Unit tests
- Documentation files (CARBON_*.md)
- This integration guide

## Troubleshooting

### Issue: Showing 0.0 kg CO2e

**Possible causes:**
1. Flight has no departure_time or arrival_time
2. Arrival time is before departure time
3. Flight duration is 0

**Solution:**
```php
$flight = Flight::find($id);
dump($flight->departure_time);
dump($flight->arrival_time);
// Check if these are properly set in the database
```

### Issue: Tests Failing

**Check:**
1. Flight factory is properly set up
2. Carbon library is imported: `use Carbon\Carbon;`
3. Database migrations have run

**Run:**
```bash
php artisan migrate
php artisan test tests/Unit/FlightCarbonEmissionTest.php --verbose
```

### Issue: High Emissions (Over 1000 kg)

**This is normal for very long flights:**
- 13 hour flight: 13 × 80 = 1,040 kg
- 14 hour flight: 14 × 80 = 1,120 kg

This is accurate for ultra long-haul flights.

## Future Integration Ideas

### 1. Add Carbon Filter to Search
```blade
<label>
    <input type="checkbox" name="low_carbon" value="1">
    <span>Show only flights under 300 kg CO₂</span>
</label>
```

### 2. Green Flight Badge
```blade
@if($flight->calculateCarbonEmissions() < 100)
    <span class="badge badge-green">🌱 Eco-Friendly</span>
@endif
```

### 3. Carbon Offset Option
```blade
@php
    $emission = $flight->calculateCarbonEmissions();
    $offsetCost = round($emission / 1000 * 15, 2); // $15 per ton
@endphp

<label>
    <input type="checkbox" name="offset_carbon">
    <span>Offset this flight for ${{ $offsetCost }}</span>
</label>
```

### 4. Comparison Display
```blade
@php
    $emission = $flight->calculateCarbonEmissions();
    $avgEmission = 250; // Average for this route
    $savings = $avgEmission - $emission;
@endphp

@if($savings > 0)
    <span class="text-green-600">
        💚 Save {{ $savings }} kg CO₂ vs. average
    </span>
@endif
```

## Conclusion

The carbon emission calculation is now:
- ✅ Fully integrated
- ✅ Production-ready
- ✅ Well-tested (16 tests)
- ✅ Properly documented
- ✅ Easy to extend

Users can now see the environmental impact of their flight choices!
