<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with([
                'booking.flight',
                'booking.user',
            ])
            ->latest('issued_at')
            ->paginate(20);

        return view('admin.tickets.index', compact('tickets'));
    }
}
