<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use function Laravel\Prompts\table;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $rules = [];

        // (update nama)
        if (!$request->has('tab') || $request->tab == 'profile') {
            $rules['full_name'] = 'required|string|max:100';
            $rules['email'] =  'required|string|email|max:100|unique:users,email,' . $user->id;
        }

        // (update password)
        if ($request->tab == 'security' || $request->filled('current_password')) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min:8|confirmed';

            // Validasi
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->route('profile.index', ['tab' => 'security'])
                    ->withErrors(['current_password' => 'Password does not match our records.'])
                    ->withInput();
            }
        }

        $request->validate($rules);

        if ($request->filled('full_name')) {
            $user->full_name = $request->full_name;
        }

        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('profile.index', ['tab' => $request->tab])
                ->with('success', 'Changes saved successfully!');
        }
    }

    public function bookings() {
        $user = Auth::user();

        $bookings = DB::table('bookings')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->join('airlines', 'flights.airline_id', '=', 'airlines.id')
            ->join('airports as origin', 'flights.origin_airport_id', '=', 'origin.id')
            ->join('airports as destination', 'flights.destination_airport_id', '=', 'destination.id')
            ->where('bookings.user_id', $user->id)
            ->select(
                'bookings.*',
                'flights.departure_time',
                'flights.arrival_time',
                'airlines.airline_name',
                'airlines.logo_url',
                'origin.city as origin_city',
                'destination.city as destination_city'
            )
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        return view('profile.bookings.index', compact('user', 'bookings'));
    }

    public function tickets() {
        $user = Auth::user();

        $tickets = DB::table('tickets')
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->join('airlines', 'flights.airline_id', '=', 'airlines.id')
            ->join('airports as origin', 'flights.origin_airport_id', '=', 'origin.id')
            ->join('airports as destination', 'flights.destination_airport_id', '=', 'destination.id')
            ->where('bookings.user_id', $user->id)
            ->select(
                'tickets.*',
                'bookings.passenger_name',
                'flights.departure_time',
                'flights.arrival_time',
                'airlines.airline_name',
                'airlines.logo_url',
                'origin.city as origin_city',
                'destination.city as destination_city'
            )
            ->orderBy('tickets.created_at', 'desc')
            ->get();

        return view('profile.tickets.index', compact('user', 'tickets'));
    }

    public function ticketDetail($ticketId) {
        $user = Auth::user();

        $ticket = DB::table('tickets')
            ->join('bookings', 'tickets.booking_id', '=', 'bookings.id')
            ->join('flights', 'bookings.flight_id', '=', 'flights.id')
            ->join('airlines', 'flights.airline_id', '=', 'airlines.id')
            ->join('airports as origin', 'flights.origin_airport_id', '=', 'origin.id')
            ->join('airports as destination', 'flights.destination_airport_id', '=', 'destination.id')
            ->where('tickets.id', $ticketId)
            ->where('bookings.user_id', $user->id)
            ->select(
                'tickets.*',
                'bookings.booking_code',
                'bookings.passenger_name',
                'flights.flight_number',
                'flights.departure_time',
                'flights.arrival_time',
                'airlines.airline_name',
                'airlines.logo_url',
                'origin.city as origin_city',
                'origin.airport_code as origin_code',
                'destination.city as destination_city',
                'destination.airport_code as destination_code'
            )
            ->first();

        if (!$ticket) {
            abort(404);
        }

        return view('profile.tickets.detail', compact('user', 'ticket'));
    }
}
