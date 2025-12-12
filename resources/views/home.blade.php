@extends('layouts.app')

@section('title', 'Home')

@section('css')
<style>
.hero-section {
    background-image: url('{{ asset('images/homepage_airplane_bg.jpeg') }}');
    background-size: cover;
}
</style>
@endsection

@section('content')

<div class="">

    {{-- HERO SECTION --}}
    <section 
        class="hero-section snap-start h-screen bg-cover bg-center bg-black/30 bg-blend-darken flex flex-col justify-center items-center">

        <div class="container mx-auto px-4 text-center mt-20 pt-4 text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-3 drop-shadow-lg">
                See Clearly, Fly Fairly
            </h1>
            <p class="text-l font-semibold drop-shadow-md mt-4 w-1/2 text-center mx-auto">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Qui accusamus, sapiente nisi corporis fugiat facilis similique voluptatibus. Inventore tenetur illo eos blanditiis enim laudantium ipsam ratione ut vero sunt. Enim!
            </p>
        </div>

        {{-- HERO BOX --}}
        <div class="container mx-auto h-full flex justify-end items-end mb-10">
            <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-2xl p-6 md:p-8 text-xs">

                <form>

                    {{-- Tabs --}}
                    <div class="flex justify-center mb-6 space-x-2">
                        <button type="button"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg font-small hover:bg-blue-700 transition">
                            Round Trip
                        </button>
                        <button type="button"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-100 transition">
                            One-Way Trip
                        </button>
                    </div>

                    {{-- Form Fields --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                        {{-- From --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Where From?</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </span>
                                <input type="text" name="from" placeholder="LWO, Lviv"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        {{-- To --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Where To?</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    </svg>
                                </span>
                                <input type="text" name="to" placeholder="LHR, London"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        {{-- Departure --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Departure</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </span>
                                <input type="date" name="departure"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        {{-- Return --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-2">Return</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </span>
                                <input type="date" name="return_date"
                                    class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                    </div>

                    {{-- Search Button --}}
                    <div class="text-center mt-6">
                        <button
                            class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition">
                            Search Flights
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>

    {{-- DISCOVER FLIGHTS SECTION --}}
    <section class="container mx-auto px-4 py-16 snap-start">

        <h1 class="text-4xl font-semibold mb-8">Discover Best Flight Choices</h1>

        {{-- Filter --}}
        <div class="flex space-x-2 mb-8">
            <button id="btnDomestic"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
                Domestic
            </button>
            <button id="btnInternational"
                class="px-6 py-2 border border-blue-600 text-blue-600 rounded-lg font-medium hover:bg-blue-50 transition">
                International
            </button>
        </div>

        {{-- Domestic --}}
        <div id="domesticRoutes"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="/images/bali_img.jpeg" class="w-full h-64 object-cover">

                <div class="p-6">
                    <div class="flex gap-2 mb-3">
                        <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full">One Way</span>
                        <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full">Domestic</span>
                    </div>

                    <h5 class="text-xl font-semibold mb-2">Jakarta - Bali</h5>
                    <p class="text-gray-600 mb-2">12 December 2025</p>
                    <p class="text-gray-600 mb-4">Rute domestik favorit dengan maskapai ramah lingkungan.</p>

                    <a href="#"
                        class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Lihat Penerbangan
                    </a>
                </div>
            </div>
            @endfor

        </div>

        {{-- International --}}
        <div id="internationalRoutes"
            class="hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            @php
                $intl = [
                    ['/images/routes/jakarta_singapore.jpg', 'Jakarta ➝ Singapore'],
                    ['/images/routes/jakarta_tokyo.jpg', 'Jakarta ➝ Tokyo'],
                    ['/images/routes/bali_sydney.jpg', 'Bali ➝ Sydney'],
                ];
            @endphp

            @foreach ($intl as $route)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ $route[0] }}" class="w-full h-64 object-cover">

                <div class="p-6">
                    <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full mb-3 inline-block">
                        International
                    </span>

                    <h5 class="text-xl font-semibold mb-2">{{ $route[1] }}</h5>
                    <p class="text-gray-600 mb-4">Rute internasional cepat dengan maskapai emisi rendah.</p>

                    <a href="#"
                        class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Lihat Penerbangan
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="container mx-auto px-4 py-16 snap-start">

        <h1 class="text-4xl font-semibold mb-8">Why Choose Us</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h5 class="text-xl font-semibold mb-3">Eco-Friendly Flights</h5>
                <p class="text-gray-600">Kami memprioritaskan maskapai rendah emisi.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h5 class="text-xl font-semibold mb-3">Transparent Pricing</h5>
                <p class="text-gray-600">Harga jelas tanpa biaya tersembunyi.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                <h5 class="text-xl font-semibold mb-3">Smart & Fast Search</h5>
                <p class="text-gray-600">Cari rute terbaik berdasarkan harga & kecepatan.</p>
            </div>

        </div>
    </section>

</div>


@section('js')
<script>
    const btnDomestic = document.getElementById('btnDomestic');
    const btnInternational = document.getElementById('btnInternational');
    const domesticRoutes = document.getElementById('domesticRoutes');
    const internationalRoutes = document.getElementById('internationalRoutes');

    btnDomestic.onclick = () => {
        domesticRoutes.classList.remove('hidden');
        domesticRoutes.classList.add('grid');
        internationalRoutes.classList.add('hidden');
        internationalRoutes.classList.remove('grid');

        btnDomestic.classList.add('bg-blue-600', 'text-white');
        btnDomestic.classList.remove('border', 'border-blue-600', 'text-blue-600');

        btnInternational.classList.add('border', 'border-blue-600', 'text-blue-600');
        btnInternational.classList.remove('bg-blue-600', 'text-white');
    };

    btnInternational.onclick = () => {
        internationalRoutes.classList.remove('hidden');
        internationalRoutes.classList.add('grid');
        domesticRoutes.classList.add('hidden');
        domesticRoutes.classList.remove('grid');

        btnInternational.classList.add('bg-blue-600', 'text-white');
        btnInternational.classList.remove('border', 'border-blue-600', 'text-blue-600');

        btnDomestic.classList.add('border', 'border-blue-600', 'text-blue-600');
        btnDomestic.classList.remove('bg-blue-600', 'text-white');
    };
</script>
@endsection

@endsection