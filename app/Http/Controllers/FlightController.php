<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{

    public function flightListPage(Request $request)
    {
        // 1. Mulai Query Dasar dengan Eager Loading
        $query = Flight::with(['airline', 'originAirport', 'destinationAirport', 'airplane', 'flightClasses'])
            ->where('status', 'Scheduled')
            ->where('departure_time', '>=', now());

        // 2. Filter Pencarian Utama (Dari Search Bar)
        if ($request->filled('from')) {
            $query->whereHas('originAirport', function($q) use ($request) {
                $q->where('id', $request->from);
            });
        }
        if ($request->filled('to')) {
            $query->whereHas('destinationAirport', function($q) use ($request) {
                $q->where('id', $request->to);
            });
        }
        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        // 3. Logika Filter Sidebar (Transit & Waktu)
        // Filter Berdasarkan Transit (Stops)
        if ($request->has('stops')) {
            $query->whereIn('stops', $request->stops);
        }

        // Filter Berdasarkan Waktu Keberangkatan
        if ($request->has('waktu')) {
            $query->where(function($q) use ($request) {
                $waktuFilters = (array) $request->waktu;
                if (in_array('pagi', $waktuFilters)) {
                    $q->orWhereTime('departure_time', '>=', '00:00')
                        ->whereTime('departure_time', '<=', '11:00');
                }
                if (in_array('siang', $waktuFilters)) {
                    $q->orWhereTime('departure_time', '>', '11:00')
                        ->whereTime('departure_time', '<=', '16:00');
                }
            });
        }

        // 4. Logika Sorting (Rekomendasi, Termurah, Tercepat)
        if ($request->get('sort') == 'cheapest') {
            $query->withMin('flightClasses', 'price')
                ->orderBy('flight_classes_min_price', 'asc');
        } elseif ($request->get('sort') == 'fastest') {
            $query->orderByRaw('TIMESTAMPDIFF(MINUTE, departure_time, arrival_time) ASC');
        } else {
            $query->orderBy('departure_time', 'asc');
        }

        // 5. Eksekusi Pagination
        // withQueryString() memastikan filter stops[] & waktu[] tidak hilang saat ganti page
        $flights = $query->paginate(10)->withQueryString();

        return view('flights.index', compact('flights'));
    }

    public function flightDetailPage(Flight $flight)
    {
        $flight->load([
            'airline',
            'airplane',
            'originAirport',
            'destinationAirport',
            'flightClasses'
        ]);

        return view('flights.show', compact('flight'));
    }

    // Admin Functions
    public function adminFlightListPage()
    {
        $getAllFlights = Flight::with(['airline', 'originAirport', 'destinationAirport'])->paginate(15);
        return view('admin.flights.index', compact('getAllFlights'));
    }
}
