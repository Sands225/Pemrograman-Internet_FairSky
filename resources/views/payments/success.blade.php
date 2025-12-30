@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="min-h-[calc(100vh-60px)] container my-auto mx-auto max-w-3xl py-20 px-4 mt-[60px] flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-lg p-10 text-center">

        {{-- Success Icon --}}
        <div class="flex justify-center mb-6">
            <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        {{-- Title --}}
        <h1 class="text-3xl font-extrabold text-gray-800 mb-2">
            Pembayaran Berhasil!
        </h1>

        <p class="text-gray-500 mb-10">
            Booking Anda telah berhasil dikonfirmasi dan tiket telah diterbitkan.
        </p>

        {{-- Booking Info --}}
        <div class="bg-gray-50 rounded-xl p-6 text-left space-y-4 mb-10">

            <div class="flex justify-between">
                <span class="text-gray-500">Kode Booking</span>
                <span class="font-semibold text-gray-800">
                    {{ $booking->booking_code }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Nama Penumpang</span>
                <span class="font-semibold text-gray-800">
                    {{ $booking->passenger_name }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Total Dibayar</span>
                <span class="font-bold text-green-600 text-lg">
                    IDR {{ number_format($booking->total_price, 0, ',', '.') }}
                </span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-500">Status Pembayaran</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full
                             bg-green-100 text-green-700 text-sm font-semibold">
                    {{ $booking->payment_status }}
                </span>
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <a href="{{ route('home') }}"
               class="inline-flex justify-center items-center px-6 py-3
                      bg-blue-600 text-white rounded-xl font-semibold
                      hover:bg-blue-700 transition">
                Kembali ke Beranda
            </a>

            {{-- <a href="{{ route('bookings.show', $booking->id ?? '#') }}"
               class="inline-flex justify-center items-center px-6 py-3
                      border border-gray-300 rounded-xl font-semibold text-gray-700
                      hover:bg-gray-100 transition">
                Lihat Detail Booking
            </a> --}}

        </div>

    </div>
</div>
@endsection
