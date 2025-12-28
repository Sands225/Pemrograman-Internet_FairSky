@extends('layouts.app')

@section('title', 'Flights')

@section('content')
    <div class="bg-gray-50 min-h-screenc pb-18 mt-[80px] mx-20">
        <div class="container mx-auto px-4">

            <h1 class="text-3xl font-bold text-gray-800 mb-8">Flight Search Results</h1>

            <div class="flex flex-col lg:flex-row gap-8">

                <aside class="w-full lg:w-1/4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-lg">Filters</h3>
                            <button class="text-sm text-blue-600 hover:underline">Reset</button>
                        </div>

                        <div class="mb-6 border-b border-gray-100 pb-6">
                            <h4 class="font-semibold mb-3 text-gray-700">Stops</h4>
                            <label class="flex items-center space-x-3 mb-2 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-600">Langsung (Direct)</span>
                            </label>
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-600">1 Transit</span>
                            </label>
                        </div>

                        <div class="mb-6 border-b border-gray-100 pb-6">
                            <h4 class="font-semibold mb-3 text-gray-700">Waktu Berangkat</h4>
                            <div class="space-y-2">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                                    <span class="text-gray-600">Pagi (00:00 - 11:00)</span>
                                </label>
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" class="rounded border-gray-300 text-blue-600">
                                    <span class="text-gray-600">Siang (11:00 - 16:00)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="w-full lg:w-3/4">

                    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" 
                        class="whitespace-nowrap px-4 py-2 text-sm font-semibold rounded-full shadow-sm transition{{ !request('sort') ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600' }}">Rekomendasi FairSky</a>
                        
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'cheapest']) }}" 
                        class="whitespace-nowrap px-4 py-2 text-sm font-semibold rounded-full shadow-sm transition{{ request('sort') == 'cheapest' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600' }}">Harga Termurah</a>
       
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'fastest']) }}" 
                        class="whitespace-nowrap px-4 py-2 text-sm font-semibold rounded-full shadow-sm transition{{ request('sort') == 'fastest' ? 'bg-blue-600 text-white' : 'bg-white border border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600' }}">Durasi Tercepat</a>
    
    </div>

                    @forelse($flights as $flight)
                        @php
                            // Ambil harga kelas Economy (atau termurah yang tersedia)
                            $economyClass = $flight->flightClasses->where('class_type', 'Economy')->first();
                            $price = $economyClass ? $economyClass->price : 0;

                            // Hitung Durasi
                            $start = \Carbon\Carbon::parse($flight->departure_time);
                            $end = \Carbon\Carbon::parse($flight->arrival_time);
                            $duration = $start->diff($end)->format('%Hj %Im');
                        @endphp

                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-5 hover:shadow-md transition-shadow duration-300">
                            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                                <div class="flex-1 w-full">
                                    <div class="flex items-center gap-3 mb-4">
                                        @if($flight->airline->logo_url)
                                            <img src="{{ $flight->airline->logo_url }}" alt="Logo" class="h-8 w-auto object-contain">
                                        @else
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold">
                                                {{ substr($flight->airline->airline_name, 0, 2) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-bold text-gray-800">{{ $flight->airline->airline_name }}</h3>
                                            <p class="text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded inline-block">{{ $flight->airplane->model ?? 'Boeing 737' }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between px-2">
                                        <div class="text-center min-w-[80px]">
                                            <p class="text-xl font-bold text-gray-800">{{ $start->format('H:i') }}</p>
                                            <p class="text-sm text-gray-500 font-medium">{{ $flight->originAirport->airport_code }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $flight->originAirport->city }}</p>
                                        </div>

                                        <div class="flex-1 flex flex-col items-center px-6">
                                            <span class="text-xs text-gray-500 mb-1 font-medium">{{ $duration }}</span>
                                            <div class="w-full h-[2px] bg-gray-300 relative">
                                                <div class="absolute -top-1.5 right-0 w-2 h-2 bg-gray-300 rounded-full"></div>
                                                <div class="absolute -top-1.5 left-0 w-2 h-2 bg-gray-300 rounded-full"></div>
                                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white px-1">
                                                    <svg class="w-4 h-4 text-gray-400 rotate-90" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <span class="text-xs text-green-600 font-medium mt-1">Langsung</span>
                                        </div>

                                        <div class="text-center min-w-[80px]">
                                            <p class="text-xl font-bold text-gray-800">{{ $end->format('H:i') }}</p>
                                            <p class="text-sm text-gray-500 font-medium">{{ $flight->destinationAirport->airport_code }}</p>
                                            <p class="text-xs text-gray-400 mt-1">{{ $flight->destinationAirport->city }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex gap-2">
                                    <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-[10px] px-2 py-1 rounded-md font-medium border border-green-100">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Info Karbon: 120 kg CO2e
                                    </span>
                                    </div>
                                </div>

                                <div class="w-full md:w-auto md:border-l md:border-gray-100 md:pl-6 flex flex-row md:flex-col justify-between items-end gap-4">
                                    <div class="text-right">
                                        @if($price > 0)
                                            <div class="flex flex-col gap-1 text-sm text-gray-500 mb-2">
                                                <div class="flex justify-end gap-3 text-xs">
                                                    <span>Tiket</span>
                                                    <span class="font-medium">IDR {{ number_format($price * 0.9, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-end gap-3 text-xs">
                                                    <span>Pajak</span>
                                                    <span class="font-medium">IDR {{ number_format($price * 0.1, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <span class="block text-xs text-gray-400 text-right mb-0.5">Total per orang</span>
                                                <span class="block text-2xl font-bold text-blue-600">
                                                IDR {{ number_format($price, 0, ',', '.') }}
                                            </span>
                                            </div>
                                        @else
                                            <span class="text-red-500 font-bold">Sold Out</span>
                                        @endif
                                    </div>
                                    
                                    <a href="{{ route('flights.show', $flight->id) }}"
                                        class="inline-block mt-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg">
                                        Pilih
                                    </a>
                                    {{-- <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-8 rounded-lg shadow-blue-200 shadow-md transition-all duration-200 transform hover:-translate-y-0.5 w-full md:w-auto">
                                        Pilih
                                    </button> --}}
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada penerbangan ditemukan</h3>
                            <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau cari tanggal lain.</p>
                        </div>
                    @endforelse

                    <div class="mt-6">
                        {{ $flights->links() }}
                    </div>

                </main>
            </div>
        </div>
    </div>
@endsection
