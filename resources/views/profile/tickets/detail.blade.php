@extends('layouts.app')

@section('title', 'Ticket Detail')

@section('content')
<div class="bg-gray-50 min-h-screen pt-24 pb-10">
    <div class="container mx-auto px-4 max-w-5xl">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Ticket Detail</h1>
                <p class="text-gray-500 text-sm mt-1">
                    Ticket No: {{ $ticket->ticket_number }}
                </p>
            </div>
            <a href="{{ route('profile.tickets.index') }}"
               class="text-sm font-bold text-blue-600 hover:underline">
                ← Back to My Tickets
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- MAIN TICKET INFO --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-4 mb-6">
                    @if($ticket->logo_url)
                        <img src="{{ asset($ticket->logo_url) }}" class="w-12 h-12 object-contain">
                    @endif
                    <div>
                        <p class="font-bold text-xl text-gray-800">
                            {{ $ticket->origin_city }} → {{ $ticket->destination_city }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $ticket->airline_name }}
                        </p>
                    </div>
                </div>

                {{-- Flight Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-gray-500">Departure</p>
                        <p class="font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse($ticket->departure_time)->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Arrival</p>
                        <p class="font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse($ticket->arrival_time)->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Seat Number</p>
                        <p class="font-bold text-gray-800">
                            {{ $ticket->seat_number ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Class</p>
                        <p class="font-bold text-gray-800">
                            {{ $ticket->class_type }}
                        </p>
                    </div>
                </div>

                <hr class="my-6">

                {{-- Passenger --}}
                <div>
                    <h3 class="font-semibold text-gray-800 mb-4">Passenger Information</h3>
                    <p class="text-sm">
                        <span class="text-gray-500">Name:</span>
                        <span class="font-bold text-gray-800">{{ $ticket->passenger_name }}</span>
                    </p>
                </div>
            </div>

            {{-- SIDEBAR --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-semibold mb-4">Ticket Status</h3>

                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold
                    {{ $ticket->eticket_status === 'Used'
                        ? 'bg-gray-100 text-gray-700'
                        : 'bg-green-100 text-green-700' }}">
                    {{ $ticket->eticket_status }}
                </span>

                <hr class="my-6">

                <div class="space-y-3 text-sm">
                    <p>
                        <span class="text-gray-500">Booking Code:</span><br>
                        <span class="font-bold text-gray-800">{{ $ticket->booking_code }}</span>
                    </p>

                    <p>
                        <span class="text-gray-500">Issued At:</span><br>
                        <span class="font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse($ticket->created_at)->format('d M Y, H:i') }}
                        </span>
                    </p>
                </div>

                {{-- OPTIONAL ACTION --}}
                <a href="#"
                   class="block text-center mt-6 bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                    Download Ticket
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
