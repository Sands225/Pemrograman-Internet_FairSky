<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{

    public function index(Request $request)
{
    // 1. Mulai Query Dasar
    $query = Flight::with(['airline', 'originAirport', 'destinationAirport', 'airplane', 'flightClasses'])
        ->where('status', 'Scheduled')
        ->where('departure_time', '>=', now());

    // 2. Logika Sorting (Filter)
    if ($request->get('sort') == 'cheapest') {
        // [HARGA TERMURAH]
        // gunakan withMin untuk mengambil harga terendah dari tabel relasi flight_classes
        // lalu urutkan berdasarkan hasil tersebut
        $query->withMin('flightClasses', 'price')
              ->orderBy('flight_classes_min_price', 'asc');

    } elseif ($request->get('sort') == 'fastest') {
        // [DURASI TERCEPAT]
        // hitung selisih waktu (Arrival - Departure) menggunakan fungsi MySQL
        $query->orderByRaw('TIMESTAMPDIFF(MINUTE, departure_time, arrival_time) ASC');

    } else {
        // [DEFAULT / REKOMENDASI]
        // mengurutkan berdasarkan keberangkatan paling awal
        $query->orderBy('departure_time', 'asc');
    }

    // 3. Eksekusi Pagination
    // withQueryString() penting agar saat pindah page 2, filter sort tidak hilang
    $flights = $query->paginate(10)->withQueryString();

    return view('flights', compact('flights'));
}

}

    