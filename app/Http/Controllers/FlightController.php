<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Airplane;
use Illuminate\Validation\Rule;

class FlightController extends Controller
{

    public function flightListPage(Request $request)
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

    public function editFlightPage(Flight $flight)
    {
        $flight->load(['airline', 'airplane', 'originAirport', 'destinationAirport', 'flightClasses']);
        return view('admin.flights.edit', compact('flight'));
    }

    public function editFlight(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number' => [
                'required',
                'string',
                Rule::unique('flights', 'flight_number')->ignore($flight->id),
            ],
            'airline_id' => 'required|exists:airlines,id',
            'airplane_id' => 'required|exists:airplanes,id',
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id|different:origin_airport_id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|in:Scheduled,Cancelled,Delayed',
        ]);

        Airplane::where('id', $validated['airplane_id'])
            ->where('airline_id', $validated['airline_id'])
            ->firstOrFail();

        $flight->update($validated);

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Flight updated successfully');
    }


    public function createFlightPage()
    {
        $airlines = Airline::all();
        $airports = Airport::all();
        $airplanes = Airplane::all();

        return view('admin.flights.create', compact('airlines', 'airports', 'airplanes'));
    }

    public function createFlight(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|string|max:10',
            'airline_id' => 'required|exists:airlines,id',
            'airplane_id' => 'required|exists:airplanes,id',
            'origin_airport_id' => 'required|different:destination_airport_id',
            'destination_airport_id' => 'required',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            // 'base_price' => 'required|numeric|min:0',
        ]);
        $validated['status'] = 'Scheduled';

        $flight = Flight::create($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight created successfully.');
    }

    public function deleteFlight(Flight $flight)
    {
        DB::transaction(function () use ($flight) {
            // Hapus kelas penerbangan terkait
            $flight->flightClasses()->delete();

            // Hapus penerbangan
            $flight->delete();
        });

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight deleted successfully.');
    }
}

    