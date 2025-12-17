@extends('layouts.app')

@section('title', 'Detail Penerbangan')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-5xl">

        {{-- Header --}}
        <div class="mb-6">
            <a href="{{ url()->previous() }}"
               class="text-sm text-blue-600 hover:underline">
                ← Kembali ke hasil pencarian
            </a>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Detail Penerbangan
        </h1>

        {{-- Card Detail --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

            {{-- Airline --}}
            <div class="flex items-center gap-4 mb-6">
                @if($flight->airline->logo_url)
                    <img src="{{ $flight->airline->logo_url }}"
                         alt="Logo Airline"
                         class="h-10 object-contain">
                @else
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-600">
                        {{ substr($flight->airline->airline_name, 0, 2) }}
                    </div>
                @endif

                <div>
                    <h2 class="font-bold text-lg text-gray-800">
                        {{ $flight->airline->airline_name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ $flight->airplane->model ?? 'Boeing 737' }}
                    </p>
                </div>
            </div>

            {{-- Route --}}
            @php
                $departure = \Carbon\Carbon::parse($flight->departure_time);
                $arrival = \Carbon\Carbon::parse($flight->arrival_time);
                $duration = $departure->diff($arrival)->format('%Hj %Im');
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center mb-8">

                {{-- Origin --}}
                <div class="text-center">
                    <p class="text-xl font-bold">{{ $departure->format('H:i') }}</p>
                    <p class="font-semibold">{{ $flight->originAirport->airport_code }}</p>
                    <p class="text-sm text-gray-500">{{ $flight->originAirport->city }}</p>
                </div>

                {{-- Duration --}}
                <div class="flex flex-col items-center">
                    <span class="text-xs text-gray-500 mb-2">{{ $duration }}</span>
                    <div class="w-full h-[2px] bg-gray-300 relative">
                        <div class="absolute left-0 -top-1.5 w-2 h-2 bg-gray-300 rounded-full"></div>
                        <div class="absolute right-0 -top-1.5 w-2 h-2 bg-gray-300 rounded-full"></div>
                    </div>
                    <span class="text-xs text-green-600 mt-2 font-medium">
                        Langsung
                    </span>
                </div>

                {{-- Destination --}}
                <div class="text-center">
                    <p class="text-xl font-bold">{{ $arrival->format('H:i') }}</p>
                    <p class="font-semibold">{{ $flight->destinationAirport->airport_code }}</p>
                    <p class="text-sm text-gray-500">{{ $flight->destinationAirport->city }}</p>
                </div>

            </div>

            {{-- Flight Info --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 text-sm">
                <div>
                    <p class="text-gray-500">Tanggal Keberangkatan</p>
                    <p class="font-medium">
                        {{ $departure->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Durasi Penerbangan</p>
                    <p class="font-medium">
                        {{ $duration }}
                    </p>
                </div>
            </div>

            {{-- Classes & Prices --}}
            <h3 class="font-bold text-gray-800 mb-4">
                Pilih Kelas Penerbangan
            </h3>

            <div class="space-y-3">
                @foreach($flight->flightClasses as $class)
                    <div class="flex items-center justify-between border border-gray-100 rounded-lg p-4 hover:border-blue-400 transition">
                        <div>
                            <p class="font-semibold">{{ $class->class_type }}</p>
                            <p class="text-xs text-gray-500">
                                Bagasi {{ $class->baggage ?? 20 }}kg · Kursi nyaman
                            </p>
                        </div>

                        <div class="text-right">
                            <p class="font-bold text-blue-600 text-lg">
                                IDR {{ number_format($class->price, 0, ',', '.') }}
                            </p>

                            <a href="{{ route('bookings.create', $class->id) }}"
                                class="inline-block mt-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                                Pilih
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
