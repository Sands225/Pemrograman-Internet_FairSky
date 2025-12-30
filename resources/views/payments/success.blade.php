@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="container mx-auto max-w-3xl py-16 text-center">

    <div class="bg-white p-10 rounded-xl shadow">
        <h1 class="text-3xl font-bold text-green-600 mb-4">
            Pembayaran Berhasil 🎉
        </h1>

        <p class="text-gray-600 mb-6">
            Booking Anda telah berhasil dikonfirmasi.
        </p>

        <div class="text-left text-gray-700 space-y-2 mb-6">
            <p><strong>Kode Booking:</strong> {{ $booking->booking_code }}</p>
            <p><strong>Nama Penumpang:</strong> {{ $booking->passenger_name }}</p>
            <p><strong>Total Dibayar:</strong>
                IDR {{ number_format($booking->total_price, 0, ',', '.') }}
            </p>
            <p><strong>Status:</strong>
                <span class="text-green-600 font-semibold">
                    {{ $booking->payment_status }}
                </span>
            </p>
        </div>

        <a href="{{ route('home') }}"
           class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Kembali ke Beranda
        </a>
    </div>

</div>
@endsection
