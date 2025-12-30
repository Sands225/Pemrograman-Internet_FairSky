@extends('layouts.app')

@section('title', 'Konfirmasi Booking')

@section('content')
<div class="container mx-auto max-w-4xl py-10">

    <h1 class="text-3xl font-bold mb-8">
        Konfirmasi Booking
    </h1>

    {{-- DATA PENUMPANG --}}
    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">
            Data Penumpang
        </h2>
        <div class="text-gray-700 space-y-2">
            <p><strong>Nama:</strong> {{ $data['passenger_name'] }}</p>
            <p><strong>Telepon:</strong> {{ $data['passenger_phone'] }}</p>
            @if(isset($data['passenger_email']))
                <p><strong>Email:</strong> {{ $data['passenger_email'] }}</p>
            @endif
        </div>
    </div>

    {{-- DETAIL PENERBANGAN --}}
    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">
            Detail Penerbangan
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p>
                <strong>Rute:</strong>
                {{ $flightClass->flight->originAirport->airport_code }}
                →
                {{ $flightClass->flight->destinationAirport->airport_code }}
            </p>

            <p>
                <strong>Waktu Keberangkatan:</strong>
                {{ \Carbon\Carbon::parse($flightClass->flight->departure_time)->translatedFormat('d F Y, H:i') }}
            </p>

            <p>
                <strong>Maskapai:</strong>
                {{ $flightClass->flight->airline->airline_name }}
            </p>

            <p>
                <strong>Kelas:</strong>
                {{ $flightClass->class_type }}
            </p>
        </div>
    </div>

    {{-- RINGKASAN HARGA --}}
    <div class="bg-white p-6 rounded-xl shadow mb-6">
        <h2 class="text-lg font-semibold mb-4">
            Ringkasan Pembayaran
        </h2>
        <div class="text-gray-700 space-y-2">
            <div class="flex justify-between">
                <span>Harga Tiket</span>
                <span>IDR {{ number_format($data['price'], 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span>Pajak & Biaya</span>
                <span>IDR {{ number_format($data['tax'] ?? 0, 0, ',', '.') }}</span>
            </div>
            <hr>
            <div class="flex justify-between font-bold text-lg">
                <span>Total</span>
                <span class="text-green-600">
                    IDR {{ number_format($data['total_price'], 0, ',', '.') }}
                </span>
            </div>
        </div>
    </div>

    {{-- CATATAN PENTING --}}
    <div class="bg-yellow-50 border border-yellow-200 p-5 rounded-xl mb-8 text-sm text-gray-700">
        <p class="font-semibold mb-2">Catatan Penting:</p>
        <ul class="list-disc ml-5 space-y-1">
            <li>Pastikan nama penumpang sesuai dengan identitas resmi.</li>
            <li>Tiket yang sudah dibeli tidak dapat diubah atau dibatalkan.</li>
            <li>Kesalahan data menjadi tanggung jawab pemesan.</li>
        </ul>
    </div>

    {{-- FORM SUBMIT --}}
<form action="{{ route('payments.create') }}" method="GET">
    <button class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-bold">
        Lanjut ke Pembayaran
    </button>
</form>

</div>

<pre class="bg-gray-100 p-4 rounded text-xs overflow-auto mb-6">
{{ json_encode($flightClass, JSON_PRETTY_PRINT) }}
{{ json_encode($data, JSON_PRETTY_PRINT) }}
</pre>
@endsection
