@extends('admin.layouts.dashboard')

@section('title', 'Bookings Management')

@section('content')
<div class="min-h-[calc(100vh-5rem)] bg-gray-50">
    <div class="container mx-auto max-w-7xl px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Bookings</h1>
            <p class="text-gray-500 mt-1">All customer flight bookings</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">

            {{-- Search --}}
            <form method="GET" class="flex gap-3 mb-4">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Search booking code / passenger..."
                       class="px-3 py-2 border rounded-lg text-sm w-72">

                <button class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.bookings.index') }}"
                       class="px-4 py-2 bg-gray-200 text-sm rounded-lg">
                        Clear
                    </a>
                @endif
            </form>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600 text-center">
                        <tr>
                            <th class="p-3">Code</th>
                            <th class="p-3">Passenger</th>
                            <th class="p-3">Flight</th>
                            <th class="p-3">Total</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Payment</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-center">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-mono">{{ $booking->booking_code }}</td>
                            <td class="p-3">{{ $booking->passenger_name }}</td>
                            <td class="p-3">
                                {{ $booking->flight->flight_number ?? '-' }}
                            </td>
                            <td class="p-3">
                                Rp {{ number_format($booking->total_price) }}
                            </td>
                            <td class="p-3">
                                @php
                                    $statusColors = [
                                        'confirmed' => 'bg-green-100 text-green-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                @php
                                    $paymentColors = [
                                        'Paid' => 'bg-green-100 text-green-700',
                                        'Pending' => 'bg-yellow-100 text-yellow-700',
                                        'Failed' => 'bg-red-100 text-red-700',
                                        'Refunded' => 'bg-purple-100 text-purple-700',
                                    ];
                                @endphp

                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $paymentColors[$booking->payment_status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ $booking->payment_status }}
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                   class="text-blue-600 hover:underline text-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-6 text-gray-500 text-center">
                                No bookings found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $bookings->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
