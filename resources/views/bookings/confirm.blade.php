@extends('layouts.app')

@section('title', 'Konfirmasi Booking')

@section('content')
<div class="container mx-auto max-w-3xl py-10">

    <h1 class="text-2xl font-bold mb-6">Konfirmasi Booking</h1>

    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <p><strong>Nama:</strong> {{ $data['passenger_name'] }}</p>
        <p><strong>Telepon:</strong> {{ $data['passenger_phone'] }}</p>
    </div>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        @foreach($data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-bold">
            Konfirmasi & Booking
        </button>
    </form>
</div>
@endsection
