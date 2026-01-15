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
        $airports = Airport::orderBy('city', 'asc')->get();
        $airlines = Airline::all(); 

        $query = Flight::with(['airline', 'originAirport', 'destinationAirport', 'airplane', 'flightClasses'])
            ->where('status', 'Scheduled')
            ->where('departure_time', '>=', now());

        if ($request->filled('from')) {
            $query->where('origin_airport_id', $request->from);
        }
        if ($request->filled('to')) {
            $query->where('destination_airport_id', $request->to);
        }
        if ($request->filled('date')) {
            $query->whereDate('departure_time', $request->date);
        }

        if ($request->has('waktu')) {
            $query->where(function($q) use ($request) {
                $w = (array) $request->waktu;
                if (in_array('pagi', $w)) $q->orWhereTime('departure_time', '>=', '06:00')->whereTime('departure_time', '<=', '11:00');
                if (in_array('siang', $w)) $q->orWhereTime('departure_time', '>', '11:00')->whereTime('departure_time', '<=', '16:00');
                if (in_array('malam', $w)) $q->orWhereTime('departure_time', '>', '16:00')->orWhereTime('departure_time', '<', '06:00');
            });
        }

        if ($request->has('tiba')) {
            $query->where(function($q) use ($request) {
                $t = (array) $request->tiba;
                if (in_array('pagi', $t)) $q->orWhereTime('arrival_time', '>=', '06:00')->whereTime('arrival_time', '<=', '11:00');
                if (in_array('siang', $t)) $q->orWhereTime('arrival_time', '>', '11:00')->whereTime('arrival_time', '<=', '16:00');
                if (in_array('malam', $t)) $q->orWhereTime('arrival_time', '>', '16:00')->orWhereTime('arrival_time', '<', '06:00');
            });
        }

        if ($request->has('filter_airlines')) {
            $query->whereIn('airline_id', $request->filter_airlines);
        }

        if ($request->filled('min_price')) {
            $query->whereHas('flightClasses', function($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            });
        }

        if ($request->filled('max_price')) {
            $query->whereHas('flightClasses', function($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            });
        }

        // International
        if ($request->get('type') == 'international') {
            $query->where(function($q) {
                $q->whereHas('originAirport', function($a) {
                    $a->where('is_international', true);
                })->orWhereHas('destinationAirport', function($a) {
                    $a->where('is_international', true);
                });
            });
        }

        // Sorting
        if ($request->get('sort') == 'cheapest') {
            $query->withMin('flightClasses', 'price')->orderBy('flight_classes_min_price', 'asc');
        } elseif ($request->get('sort') == 'fastest') {
            $query->orderByRaw('TIMESTAMPDIFF(MINUTE, departure_time, arrival_time) ASC');
        } else {
            // Default sorting jika tidak memilih termurah/tercepat/internasional
            $query->orderBy('departure_time', 'asc');
        }

        $flights = $query->paginate(10)->withQueryString();

        return view('flights.index', compact('flights', 'airports', 'airlines'));
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

    public function adminFlightListPage(Request $request)
    {
        $search = $request->input('search');

        $getAllFlights = Flight::with([
                'airline',
                'originAirport',
                'destinationAirport'
            ])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('airline', function ($q) use ($search) {
                            $q->where('airline_name', 'like', "%{$search}%");
                        })
                    ->orWhereHas('originAirport', function ($q) use ($search) {
                            $q->where('airport_code', 'like', "%{$search}%");
                        })
                    ->orWhereHas('destinationAirport', function ($q) use ($search) {
                            $q->where('airport_code', 'like', "%{$search}%");
                        })
                    ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->paginate(10)
            ->withQueryString(); // keeps search when paginating

        return view('admin.flights.index', compact('getAllFlights', 'search'));
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

        $flight->update($validated);

        return redirect()->route('admin.flights.index')->with('success', 'Flight updated successfully');
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
        ]);
        $validated['status'] = 'Scheduled';

        Flight::create($validated);

        return redirect()->route('admin.flights.index')->with('success', 'Flight created successfully.');
    }

    public function deleteFlight(Flight $flight)
    {
        DB::transaction(function () use ($flight) {
            $flight->flightClasses()->delete();
            $flight->delete();
        });

        return redirect()->route('admin.flights.index')->with('success', 'Flight deleted successfully.');
    }
}
