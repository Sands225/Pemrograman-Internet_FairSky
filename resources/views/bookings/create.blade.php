@extends('layouts.app')

@section('title', 'Booking')

@section('content')
<div class="container mx-auto max-w-3xl py-10 mt-[60px]">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ url()->previous() }}"
        class="inline-flex items-center text-sm text-blue-600 hover:underline">
            ← Kembali
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">Isi Data Penumpang</h1>

    {{-- Ringkasan Penerbangan --}}
    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6 text-sm">
        <p class="font-semibold text-blue-800 mb-1">
            {{ $flightClass->flight->airline->airline_name }}
            ({{ $flightClass->flight->flight_number ?? '-' }})
        </p>
        <p>
            {{ $flightClass->flight->originAirport->airport_code }}
            →
            {{ $flightClass->flight->destinationAirport->airport_code }}
            · {{ \Carbon\Carbon::parse($flightClass->flight->departure_time)->translatedFormat('d F Y, H:i') }}
        </p>
        <p class="text-gray-600">
            Kelas: {{ $flightClass->class_type }} ·
            Bagasi {{ $flightClass->baggage ?? 20 }}kg
        </p>
    </div>

    <form action="{{ route('bookings.confirm') }}" method="POST"
          class="bg-white p-6 rounded-xl shadow space-y-5">
        @csrf

        <input type="hidden" name="flight_class_id" value="{{ $flightClass->id }}">

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <select name="passenger_title" required
                    class="w-full border rounded-lg px-4 py-2">
                <option value="">Pilih</option>
                <option value="MR">MR</option>
                <option value="MRS">MRS</option>
                <option value="MS">MS</option>
                <option value="MSTR">MSTR</option>
            </select>
        </div>

        {{-- Nama Lengkap --}}
        <div>
            <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="passenger_name" required
                   placeholder="Sesuai KTP / Paspor"
                   class="w-full border rounded-lg px-4 py-2">
            <p class="text-xs text-gray-500 mt-1">
                Nama harus sesuai identitas resmi, tanpa singkatan
            </p>
        </div>

        {{-- Tipe Penumpang --}}
        <div>
            <label class="block text-sm font-medium mb-1">Tipe Penumpang</label>
            <select name="passenger_type" required
                    class="w-full border rounded-lg px-4 py-2">
                <option value="adult">Dewasa</option>
                <option value="child">Anak</option>
                <option value="infant">Bayi</option>
            </select>
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="passenger_email" required
                   placeholder="contoh@email.com"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- No Telepon --}}
        <div>
            <label class="block text-sm font-medium mb-1">No. Telepon</label>
            <input type="text" name="passenger_phone" required
                   placeholder="08xxxxxxxxxx"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        {{-- Warning --}}
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-sm text-yellow-800">
            ⚠️ Pastikan data penumpang sudah benar.  
            Kesalahan nama dapat menyebabkan gagal check-in.
        </div>

        {{-- Checkbox Konfirmasi --}}
        <div class="flex items-start gap-2">
            <input type="checkbox" required class="mt-1">
            <p class="text-sm text-gray-600">
                Saya memastikan data penumpang yang diisi sudah benar
            </p>
        </div>

        {{-- Footer --}}
        <div class="flex justify-between items-center pt-4 border-t">
            <div>
                <p class="text-sm text-gray-500">Total Harga</p>
                <p class="font-bold text-lg">
                    IDR {{ number_format($flightClass->price, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-400">
                    Termasuk pajak & biaya bandara
                </p>
            </div>

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">
                Lanjutkan
            </button>
        </div>
    </form>
</div>
@endsection
