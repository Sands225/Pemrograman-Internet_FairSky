@extends('layouts.app')

@section('title', 'Booking')

@section('content')
<div class="container mx-auto max-w-3xl py-10 my-10">

    <h1 class="text-2xl font-bold mb-6">Isi Data Penumpang</h1>

    <form action="{{ route('bookings.confirm') }}" method="POST" class="bg-white p-6 rounded-xl shadow">
        @csrf

        <input type="hidden" name="flight_class_id" value="{{ $flightClass->id }}">

        <div class="mb-4">
            <label class="block text-sm font-medium">Nama Lengkap</label>
            <input type="text" name="passenger_name" required
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium">No. Telepon</label>
            <input type="text" name="passenger_phone" required
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="flex justify-between items-center">
            <span class="font-bold text-lg">
                IDR {{ number_format($flightClass->price, 0, ',', '.') }}
            </span>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                Lanjutkan
            </button>
        </div>
    </form>
</div>
@endsection
