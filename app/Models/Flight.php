<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Maskapai
    public function airplane()
    {
        // memberitahu Flight punya relasi ke tabel airplanes
        return $this->belongsTo(Airplane::class, 'airplane_id');
    }
    public function airline()
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    // Relasi ke Bandara Asal
    public function originAirport()
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    // Relasi ke Bandara Tujuan
    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    // Relasi ke Kelas Penerbangan (Untuk ambil Harga)
    public function flightClasses()
    {
        return $this->hasMany(FlightClass::class, 'flight_id');
    }

    /**
     * Calculate estimated CO₂ emissions per passenger based on flight duration.
     *
     * Uses a piecewise emission factor model that accounts for:
     * - Short flights: Higher fuel consumption per hour (takeoff/landing overhead)
     * - Medium flights: Moderate efficiency
     * - Long flights: Better fuel efficiency at cruise altitude
     *
     * Model:
     * < 1 hour  → 120 kg CO₂/hour (short-haul, high overhead)
     * 1–3 hours → 100 kg CO₂/hour (regional)
     * 3–6 hours → 90 kg CO₂/hour (medium-haul)
     * 6+ hours  → 80 kg CO₂/hour (long-haul, optimized cruise)
     *
     * @return float Estimated CO₂ emissions in kg per passenger (rounded to 1 decimal)
     * @throws \Exception If flight duration cannot be calculated
     */
    public function calculateCarbonEmissions()
    {
        // Validate that required timestamps exist
        if (!$this->departure_time || !$this->arrival_time) {
            return 0.0;
        }

        // Calculate flight duration in hours
        $departure = \Carbon\Carbon::parse($this->departure_time);
        $arrival = \Carbon\Carbon::parse($this->arrival_time);

        // Handle edge case: invalid time range
        if ($arrival <= $departure) {
            return 0.0;
        }

        $durationInHours = $departure->diffInMinutes($arrival) / 60;

        // Handle edge case: negative or zero duration
        if ($durationInHours <= 0) {
            return 0.0;
        }

        // Determine emission factor based on piecewise model
        $emissionFactor = $this->getEmissionFactor($durationInHours);

        // Calculate total emissions: duration × emission factor
        $estimatedEmission = $durationInHours * $emissionFactor;

        return round($estimatedEmission, 1);
    }

    /**
     * Get emission factor (kg CO₂/hour) based on flight duration.
     *
     * Piecewise emission model:
     * - Short flights burn more fuel per hour due to takeoff/landing overhead
     * - Long flights benefit from fuel-efficient cruise optimization
     *
     * @param float $durationInHours Flight duration in decimal hours
     * @return int Emission factor in kg CO₂/hour
     */
    private function getEmissionFactor($durationInHours)
    {
        if ($durationInHours < 1) {
            return 120; // Short flights: 120 kg CO₂/hour
        } elseif ($durationInHours <= 3) {
            return 100; // Regional: 100 kg CO₂/hour
        } elseif ($durationInHours <= 6) {
            return 90; // Medium-haul: 90 kg CO₂/hour
        } else {
            return 80; // Long-haul: 80 kg CO₂/hour
        }
    }
}
