@extends('admin.layouts.dashboard')

@section('title', 'Payments')

@section('content')
<div class="min-h-[calc(100vh-5rem)] bg-gray-50">
    <div class="container mx-auto max-w-7xl px-6 py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Payments</h1>
            <p class="text-gray-500 mt-1">Booking payment status</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600 text-center">
                        <tr>
                            <th class="p-3">Booking</th>
                            <th class="p-3">Passenger</th>
                            <th class="p-3">Amount</th>
                            <th class="p-3">Payment Status</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y text-center">
                        @foreach($payments as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 font-mono">{{ $booking->booking_code }}</td>
                            <td class="p-3">{{ $booking->passenger_name }}</td>
                            <td class="p-3">
                                Rp {{ number_format($booking->total_price) }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $booking->payment_status === 'Paid'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $booking->payment_status }}
                                </span>
                            </td>
                            <td class="p-3">
                                @if($booking->payment_status !== 'Paid')
                                <form method="POST"
                                      action="{{ route('admin.payments.markPaid', $booking) }}">
                                    @csrf
                                    <button class="text-green-600 hover:underline text-sm">
                                        Mark as Paid
                                    </button>
                                </form>
                                @else
                                —
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $payments->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
