@extends('layouts.app')

@section('title', 'Flights')

@section('content')
    <div class="bg-gray-50 min-h-screenc pb-18 mt-[80px] mx-20">
        <div class="container mx-auto px-4">

            <h1 class="text-3xl font-bold text-gray-800 mb-8">Flight Search Results</h1>

            {{-- SEARCH BAR SECTION --}}
            <div class="bg-transparent pb-12 pt-8 px-4">
                <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl p-6">
                    <form action="{{ route('flights.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">

                            {{-- Dropdown Asal --}}
                            <div class="relative">
                                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">From</label>
                                <select name="from" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-no-repeat bg-right pr-10" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C/polyline%3E%3C/svg%3E'); background-position: right 1rem center; background-size: 1em;">
                                    <option value="">Select Origin</option>
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}" {{ request('from') == $airport->id ? 'selected' : '' }}>
                                            {{ $airport->city }} ({{ $airport->iata_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown Tujuan --}}
                            <div class="relative">
                                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">To</label>
                                <select name="to" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none appearance-none bg-no-repeat bg-right pr-10" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C/polyline%3E%3C/svg%3E'); background-position: right 1rem center; background-size: 1em;">
                                    <option value="">Select Destination</option>
                                    @foreach($airports as $airport)
                                        <option value="{{ $airport->id }}" {{ request('to') == $airport->id ? 'selected' : '' }}>
                                            {{ $airport->city }} ({{ $airport->iata_code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Input Tanggal --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-2 uppercase">Departure Date</label>
                                <input type="date" name="date"
                                       min="{{ date('Y-m-d') }}"
                                       value="{{ request('date', date('Y-m-d')) }}"
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none">
                            </div>

                            {{-- Tombol Search --}}
                            <div class="md:col-span-3 mt-4">
                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-black-200 flex items-center justify-center gap-2 text-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    Cari Penerbangan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                <aside class="w-full lg:w-1/4">
                    <form action="{{ route('flights.index') }}" method="GET" id="filterForm">
                        {{-- Parameter pencarian utama agar tidak hilang --}}
                        @foreach(request()->only(['from', 'to', 'date', 'sort']) as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="font-bold text-xl text-gray-800">Filter</h3>
                                <a href="{{ route('flights.index', request()->only(['from', 'to', 'date'])) }}" class="text-sm font-semibold text-blue-600">Reset</a>
                            </div>

                            {{-- FILTER HARGA --}}
                            <div class="mb-8">
                                <h4 class="font-bold mb-4 text-gray-700 text-sm flex items-center gap-2">
                                    Rentang Harga
                                </h4>
                                <div class="space-y-3">
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-400 text-xs font-bold">IDR</span>
                                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Minimum"
                                               class="w-full pl-10 pr-4 py-2 text-sm border border-gray-100 rounded-xl focus:ring-1 focus:ring-blue-500 outline-none transition">
                                    </div>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-400 text-xs font-bold">IDR</span>
                                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Maksimum"
                                               class="w-full pl-10 pr-4 py-2 text-sm border border-gray-100 rounded-xl focus:ring-1 focus:ring-blue-500 outline-none transition">
                                    </div>
                                    <button type="submit" class="w-full bg-blue-50 text-blue-600 font-bold py-2 rounded-xl text-xs hover:bg-blue-100 transition mt-2">
                                        Terapkan Harga
                                    </button>
                                </div>
                            </div>

                            {{-- FILTER MASKAPAI (Update Jalur Logo) --}}
                            <div class="mb-8">
                                <h4 class="font-bold mb-4 text-gray-700 text-sm flex items-center gap-2">
                                    Maskapai
                                </h4>
                                <div class="space-y-3 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                                    @foreach($airlines as $airline)
                                        <label class="flex items-center space-x-3 cursor-pointer group">
                                            <input type="checkbox" name="filter_airlines[]" value="{{ $airline->id }}" onchange="this.form.submit()"
                                                   {{ in_array($airline->id, (array)request('filter_airlines')) ? 'checked' : '' }}
                                                   class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition">

                                            <img src="{{ asset($airline->logo_url) }}"
                                                 alt="{{ $airline->airline_name }}"
                                                 class="w-6 h-6 object-contain">

                                            <span class="text-xs text-gray-600 group-hover:text-gray-900 transition">  {{ $airline->airline_name }}
                                            </span>
                                            </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- 3. FILTER WAKTU TIBA --}}
                            <div class="mb-8">
                                <h4 class="font-bold mb-4 text-gray-700 text-sm">Waktu Tiba</h4>
                                <div class="grid grid-cols-1 gap-2">
                                    @foreach(['pagi' => '06:00 - 11:00', 'siang' => '11:00 - 16:00', 'malam' => '16:00 - 06:00'] as $key => $time)
                                        <label class="relative flex flex-col p-2.5 border rounded-xl cursor-pointer transition {{ in_array($key, (array)request('tiba')) ? 'border-blue-500 bg-blue-50' : 'border-gray-50 hover:border-blue-200' }}">
                                            <input type="checkbox" name="tiba[]" value="{{ $key }}" class="hidden" onchange="this.form.submit()" {{ in_array($key, (array)request('tiba')) ? 'checked' : '' }}>
                                            <span class="text-[10px] font-bold {{ in_array($key, (array)request('tiba')) ? 'text-blue-700' : 'text-gray-600' }}">{{ ucfirst($key) }}</span>
                                            <span class="text-[8px] text-gray-400 font-bold uppercase">{{ $time }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">Terapkan Harga</button>
                        </div>
                    </form>
                </aside>

                <main class="w-full lg:w-3/4">

                    {{-- SORTING TABS --}}
                    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => null, 'type' => null]) }}"
                           class="whitespace-nowrap px-6 py-2.5 text-sm font-bold rounded-full transition
       {{ (!request('sort') && !request('type')) ? 'bg-blue-600 text-white shadow-lg' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                            Rekomendasi FairSky
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'cheapest', 'type' => null]) }}"
                           class="whitespace-nowrap px-6 py-2.5 text-sm font-bold rounded-full transition
       {{ request('sort') == 'cheapest' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                            Harga Termurah
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'fastest', 'type' => null]) }}"
                           class="whitespace-nowrap px-6 py-2.5 text-sm font-bold rounded-full transition
       {{ request('sort') == 'fastest' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                            Durasi Tercepat
                        </a>

                        <a href="{{ request()->fullUrlWithQuery(['type' => 'international', 'sort' => null]) }}"
                           class="whitespace-nowrap px-6 py-2.5 text-sm font-bold rounded-full transition
       {{ request('type') == 'international' ? 'bg-blue-600 text-white shadow-lg' : 'bg-white border border-gray-200 text-gray-600 hover:bg-gray-50' }}">
                            International
                        </a>
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
                                            <img src="{{ $flight->airline->logo_url }}" alt="Logo" class="w-12 h-12 object-contain">
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
