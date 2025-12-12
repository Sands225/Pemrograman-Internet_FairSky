<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    // Nama function ini harus 'index' agar cocok dengan route di atas
    public function index()
    {
        // 1. Ambil data flight (sesuaikan logika filter jika perlu)
        $flights = Flight::with(['airline', 'originAirport', 'destinationAirport', 'flightClasses'])
            ->where('status', 'Scheduled')
            ->orderBy('departure_time', 'asc')
            ->paginate(10);

        // 2. Tampilkan view
        return view('flights', compact('flights'));
    }
}