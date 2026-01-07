<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\BookingAddon;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $ticketRevenue = Payment::where('payment_status', 'Paid')->sum('amount');

        $offsetRevenue = BookingAddon::select(
            DB::raw('SUM(price * COALESCE(quantity, 1)) as total')
        )
        // ->whereIn('type', ['insurance', 'other']) // offset-related
        ->value('total') ?? 0;

        $overallRevenue = $ticketRevenue + $offsetRevenue;

        $performance = Payment::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(amount) as total')
            )
            ->where('payment_status', 'Paid')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $totalFlights = Flight::count();

        $totalTickets = Booking::where('payment_status', 'Paid')
            ->count();

        $activeRoutes = Flight::select('origin_airport_id', 'destination_airport_id')
            ->where('status', 'Scheduled')
            ->distinct()
            ->count();

        $routes = DB::table('flights')
            ->join('airports as o', 'flights.origin_airport_id', '=', 'o.id')
            ->join('airports as d', 'flights.destination_airport_id', '=', 'd.id')
            ->select(
                'o.airport_name as origin',
                'd.airport_name as destination',
                DB::raw('COUNT(flights.id) as total')
            )
            ->where('flights.status', 'Scheduled')
            ->groupBy('o.airport_name', 'd.airport_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'overallRevenue',
            'ticketRevenue',
            'offsetRevenue',
            'performance',
            'routes',
            'totalFlights',
            'totalTickets',
            'activeRoutes'
        ));
    }
}