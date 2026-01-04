@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container mx-auto max-w-6xl py-10 mt-[60px] grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- ================= LEFT SIDE (PAYMENT FORM) ================= --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- STEP INDICATOR --}}
        <div class="flex items-center text-sm text-gray-500 gap-4">
            <span class="font-semibold text-blue-600">1. Pilih Penerbangan</span>
            <span>→</span>
            <span class="font-semibold text-blue-600">2. Data Penumpang</span>
            <span>→</span>
            <span class="font-semibold text-blue-600">3. Pembayaran</span>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 my-6">
            Detail Penerbangan
        </h1>

        <form action="{{ route('payments.create', $booking->id) }}"
              method="POST"
              class="bg-white rounded-xl shadow p-6 space-y-8">
            @csrf

            {{-- ================= PAYMENT METHOD ================= --}}
            <h2 class="text-lg font-bold border-b pb-2">Metode Pembayaran</h2>

            <div class="space-y-4 text-sm">

                <label class="flex items-center justify-between border rounded-lg p-4 cursor-pointer hover:border-blue-500">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment_method" value="transfer" required>
                        <span class="font-medium">Transfer Bank</span>
                    </div>
                    <span class="text-gray-400">Virtual Account</span>
                </label>

                <label class="flex items-center justify-between border rounded-lg p-4 cursor-pointer hover:border-blue-500">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment_method" value="ewallet">
                        <span class="font-medium">E-Wallet</span>
                    </div>
                    <span class="text-gray-400">OVO, GoPay, DANA</span>
                </label>

                <label class="flex items-center justify-between border rounded-lg p-4 cursor-pointer hover:border-blue-500">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="payment_method" value="credit_card">
                        <span class="font-medium">Kartu Kredit</span>
                    </div>
                    <span class="text-gray-400">Visa / MasterCard</span>
                </label>
            </div>

            {{-- CONFIRM --}}
            <label class="flex items-start gap-2 text-sm">
                <input type="checkbox" required class="mt-1">
                Saya menyetujui dan memahami proses pembayaran
            </label>

            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                Bayar Sekarang
            </button>
        </form>
    </div>

    {{-- ================= RIGHT SIDE (DETAILED SUMMARY) ================= --}}
    <div class="bg-white rounded-xl shadow p-6 h-fit sticky top-24 space-y-5">

        <h3 class="font-bold text-lg">Ringkasan Booking</h3>

        {{-- FLIGHT INFO --}}
        <div class="text-sm space-y-1">
            <p class="font-semibold">
                {{ $booking->flightClass->flight->airline->airline_name }}
                <span class="text-gray-500">
                    ({{ $booking->flightClass->flight->flight_number ?? '-' }})
                </span>
            </p>

            <p class="text-gray-600">
                {{ $booking->flightClass->flight->originAirport->airport_code }}
                →
                {{ $booking->flightClass->flight->destinationAirport->airport_code }}
            </p>

            <p class="text-gray-500">
                {{ $booking->flightClass->flight->originAirport->airport_name }}
                →
                {{ $booking->flightClass->flight->destinationAirport->airport_name }}
            </p>

            <p class="text-gray-500">
                {{ \Carbon\Carbon::parse($booking->flightClass->flight->departure_time)
                    ->translatedFormat('d F Y, H:i') }}
            </p>

            <p class="text-gray-500">
                Kelas: {{ $booking->flightClass->class_type }}
            </p>
        </div>

        <hr>

        {{-- PASSENGER INFO --}}
        <div class="text-sm space-y-1">
            <p class="font-semibold">Data Penumpang</p>
            <p class="text-gray-600">
                {{ $booking->passenger_name }}
            </p>
            <p class="text-gray-500">
                {{ ucfirst($booking->passenger_type ?? 'Dewasa') }}
            </p>
        </div>

        <hr>

        {{-- PRICE BREAKDOWN --}}
        <div class="text-sm space-y-2">
            <p class="font-semibold">Rincian Harga</p>

            {{-- Ticket --}}
            <div class="flex justify-between text-gray-600">
                <span>Harga Tiket</span>
                <span>
                    IDR {{ number_format($booking->flightClass->price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Addons --}}
            @if ($booking->addons->count())
                @foreach ($booking->addons as $addon)
                    <div class="flex justify-between text-gray-600">
                        <span>
                            {{ $addon->label }}
                            {{-- @if ($addon->quantity > 1)
                                (x{{ $addon->quantity }})
                            @endif --}}
                        </span>
                        <span>
                            IDR {{ number_format($addon->price, 0, ',', '.') }}
                        </span>
                    </div>
                @endforeach
            @endif
        </div>

        <hr>

        {{-- TOTAL --}}
        <div class="flex justify-between items-center">
            <span class="font-semibold">Total Pembayaran</span>
            <span class="font-bold text-lg text-green-600">
                IDR {{ number_format($booking->total_price, 0, ',', '.') }}
            </span>
        </div>
    </div>
</div>
@endsection
