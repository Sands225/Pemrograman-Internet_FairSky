@extends('admin.layouts.dashboard')

@section('title', 'Tickets Management')

@section('content')
<div class="min-h-[calc(100vh-5rem)] bg-gray-50">
    <div class="container mx-auto max-w-7xl px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tickets</h1>
            <p class="text-gray-500 mt-1">Issued flight tickets</p>
        </div>

        {{-- Table Card --}}
        <div class="bg-white rounded-xl shadow-sm p-6">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600 text-center">
                        <tr>
                            <th class="p-3">Ticket #</th>
                            <th class="p-3">Passenger</th>
                            <th class="p-3">Flight</th>
                            <th class="p-3">Class</th>
                            <th class="p-3">Seat</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Issued At</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y text-center">
                        @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50">

                            <td class="p-3 font-mono text-left">
                                {{ $ticket->ticket_number }}
                            </td>

                            <td class="p-3">
                                {{ $ticket->booking->passenger_name }}
                            </td>

                            <td class="p-3">
                                {{ $ticket->booking->flight->flight_number ?? '-' }}
                            </td>

                            <td class="p-3">
                                {{ $ticket->class_type }}
                            </td>

                            <td class="p-3">
                                {{ $ticket->seat_number ?? '-' }}
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($ticket->eticket_status === 'Issued')
                                        bg-blue-100 text-blue-700
                                    @elseif($ticket->eticket_status === 'CheckedIn')
                                        bg-yellow-100 text-yellow-700
                                    @else
                                        bg-green-100 text-green-700
                                    @endif
                                ">
                                    {{ $ticket->eticket_status }}
                                </span>
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $ticket->issued_at->format('d M Y H:i') }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-6 text-gray-500 text-center">
                                No tickets found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $tickets->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
