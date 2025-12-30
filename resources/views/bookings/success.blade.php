@extends('layouts.app')

@section('title', 'Booking Berhasil')

@section('content')
<div class="container min-h-screen mx-auto max-w-2xl py-16 text-center">

    <div class="bg-white p-8 rounded-xl shadow">
        <svg class="mx-auto h-16 w-16 text-green-500 mb-4"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7" />
        </svg>

        <h1 class="text-2xl font-bold mb-2">Booking Berhasil</h1>

        <p class="text-gray-600 mb-6">
            Terima kasih, booking Anda telah dikonfirmasi.
        </p>

        <p class="font-semibold">
            Maskapai: {{ $booking->flightClass->flight->airline->airline_name }}
        </p>

        <p class="mt-6">
            <a href="{{ route('flights.index') }}"
               class="text-blue-600 hover:underline">
                Kembali ke pencarian
            </a>
        </p>
    </div>
</div>
@endsection
