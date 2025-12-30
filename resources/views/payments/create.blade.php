    @extends('layouts.app')

    @section('title', 'Pembayaran')

    @section('content')

    <div class="container mx-auto max-w-4xl py-10">

        <h1 class="text-3xl font-bold mb-8">
            Pembayaran
        </h1>

        {{-- RINGKASAN BOOKING --}}
        <div class="bg-white p-6 rounded-xl shadow mb-6">
            <h2 class="font-semibold mb-4">Ringkasan Booking</h2>

            <div class="text-gray-700 space-y-2">
                <p>
                    <strong>Rute:</strong>
                    {{ $booking->flightClass->flight->originAirport->airport_code }}
                    
                    {{ $booking->flightClass->flight->destinationAirport->airport_code }}
                </p>

                <p>
                    <strong>Maskapai:</strong>
                    {{ $booking->flightClass->flight->airline->airline_name }}
                </p>

                <p>
                    <strong>Kelas:</strong>
                    {{ $booking->flightClass->class_type }}
                </p>

                <p>
                    <strong>Penumpang:</strong>
                    {{ $booking->passenger_name }}
                </p>
            </div>

            <hr class="my-4">

            <div class="flex justify-between font-bold text-lg">
                <span>Total Pembayaran</span>
                <span class="text-green-600">
                    IDR {{ number_format($booking->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- {{ dd($flightClass, $data) }} --}}

        {{-- FORM PEMBAYARAN --}}
        <form action="{{ route('payments.create', $booking->id) }}" method="POST">
            @csrf

            <div class="bg-white p-6 rounded-xl shadow mb-6">
                <h2 class="font-semibold mb-4">Pilih Metode Pembayaran</h2>

                <div class="space-y-3">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="payment_method" value="transfer" required>
                        <span>Transfer Bank</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="payment_method" value="ewallet">
                        <span>E-Wallet</span>
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="payment_method" value="credit_card">
                        <span>Kartu Kredit</span>
                    </label>
                </div>
            </div>

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-bold text-lg transition">
                Bayar Sekarang
            </button>
        </form>

    </div>

    <pre class="bg-gray-100 p-4 rounded text-xs overflow-auto mb-6">
    {{ json_encode($booking, JSON_PRETTY_PRINT) }}
    </pre>
    @endsection
