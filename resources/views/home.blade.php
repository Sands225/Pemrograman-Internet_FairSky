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

        <div class="container h-full content-center mx-auto px-4 text-center mt-20 pt-4 text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-3 drop-shadow-lg">
                See Clearly, Fly Fairly
            </h1>
            <p class="text-l font-semibold drop-shadow-md mt-4 w-1/2 text-center mx-auto">
                Experience travel with zero hidden fees. We break down every cost and calculate your carbon footprint upfront, so you can book the smartest, fairest flights for your wallet and the planet.
            </p>
        </div>

        {{-- HERO BOX --}}
        <div class="container mx-auto h-full flex justify-end items-end mb-10">
            <div class="max-w-5xl mx-auto bg-white shadow-2xl rounded-2xl p-6 md:p-8 text-xs">

                <form action="{{ route('flights.index') }}" method="GET">

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
    <section class="min-h-screen snap-start flex flex-col justify-center py-16">
    <div class="container mx-auto px-20">

        <h1 class="text-4xl font-semibold mb-8 mt-16">Discover Best Flight Choices</h1>

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

    {{-- Card 1: Jakarta → Bali --}}
    <div class="min-h-[65vh] bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
        <!-- Image -->
        <img src="/images/bali_img.jpeg" class="w-full h-72 object-cover">

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">

            <!-- Destination -->
            <h5 class="text-xl font-semibold mb-1">
                Jakarta → Bali (CGK → DPS)
            </h5>
            <p class="text-gray-500 mb-3">
                A tropical paradise offering stunning beaches, rich culture, and unforgettable experiences.
            </p>

            <!-- Price -->
            <p class="text-2xl font-bold text-blue-600 mb-1">
                From IDR 950,000
            </p>

            <!-- Highlights -->
            <ul class="text-sm text-gray-600 space-y-1 my-4">
                <p class="text-lg font-semibold my-2">Highlights:</p>
                <li>☀️ Sunny weather year-round</li>
                <li>🏖️ World-class beaches & resorts</li>
                <li>🍽️ Local and international cuisine</li>
                <li>🎭 Cultural and nature attractions</li>
            </ul>

            <!-- Ideal For -->
            <div class="text-sm text-gray-600 mb-4">
                <p class="font-semibold mb-1">Ideal for:</p>
                <p>Leisure trips, honeymoons, short escapes</p>
            </div>

            <!-- CTA -->
            <a href="{{ route('flights.index', ['to' => 'DPS']) }}"
            class="mt-auto block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Search Flights
            </a>
        </div>
    </div>

    {{-- Card 2: Jakarta → Yogyakarta --}}
    <div class="min-h-[65vh] bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
        <!-- Image -->
        <img src="/images/Yogya_img.jpg" class="w-full h-72 object-cover">

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">

            <!-- Destination -->
            <h5 class="text-xl font-semibold mb-1">
                Jakarta → Yogyakarta (CGK → YIA)
            </h5>
            <p class="text-gray-500 mb-3">
                A cultural city rich in history, art, and traditional Javanese heritage.
            </p>

            <!-- Price -->
            <p class="text-2xl font-bold text-blue-600 mb-1">
                From IDR 650,000
            </p>

            <!-- Highlights -->
            <ul class="text-sm text-gray-600 space-y-1 my-4">
                <p class="text-lg font-semibold my-2">Highlights:</p>
                <li>🏯 Borobudur & Prambanan Temples</li>
                <li>🎨 Traditional arts & culture</li>
                <li>🍜 Iconic local cuisine</li>
                <li>🚶‍♂️ Relaxed and walkable city</li>
            </ul>

            <!-- Ideal For -->
            <div class="text-sm text-gray-600 mb-4">
                <p class="font-semibold mb-1">Ideal for:</p>
                <p>Cultural tourism, educational trips, backpackers</p>
            </div>

            <!-- CTA -->
            <a href="{{ route('flights.index', ['to' => 'YIA']) }}"
            class="mt-auto block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Search Flights
            </a>
        </div>
    </div>

    {{-- Card 3: Surabaya → Lombok --}}
    <div class="min-h-[65vh] bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
        <!-- Image -->
        <img src="/images/lombok_img.jpg" class="w-full h-72 object-cover">

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">

            <!-- Destination -->
            <h5 class="text-xl font-semibold mb-1">
                Surabaya → Lombok (SUB → LOP)
            </h5>
            <p class="text-gray-500 mb-3">
                An exotic island destination with pristine beaches and breathtaking landscapes.
            </p>

            <!-- Price -->
            <p class="text-2xl font-bold text-blue-600 mb-1">
                From IDR 850,000
            </p>

            <!-- Highlights -->
            <ul class="text-sm text-gray-600 space-y-1 my-4">
                <p class="text-lg font-semibold my-2">Highlights:</p>
                <li>🏝️ Gili Islands & Mandalika Beach</li>
                <li>🏔️ Mount Rinjani adventure</li>
                <li>🤿 Snorkeling & diving spots</li>
                <li>🌅 Quieter and more peaceful than Bali</li>
            </ul>

            <!-- Ideal For -->
            <div class="text-sm text-gray-600 mb-4">
                <p class="font-semibold mb-1">Ideal for:</p>
                <p>Adventure seekers, nature lovers, wellness trips</p>
            </div>
            @endfor

            <!-- CTA -->
            <a href="{{ route('flights.index', ['to' => 'LOP']) }}"
            class="mt-auto block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Search Flights
            </a>
        </div>
    </div>

</div>

        {{-- International --}}
<div id="internationalRoutes"
    class="hidden grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- Card 1: Jakarta → Singapore --}}
    <div class="min-h-[65vh] bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
        <!-- Image -->
        <img src="/images/singapore_img.jpg" class="w-full h-72 object-cover">

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">

            <!-- Badge -->
            <span class="px-3 py-1 bg-blue-600 text-white text-xs rounded-full mb-3 inline-block w-fit">
                International
            </span>

            <!-- Destination -->
            <h5 class="text-xl font-semibold mb-1">
                Jakarta → Singapore (CGK → SIN)
            </h5>
            <p class="text-gray-500 mb-3">
                A modern city destination offering world-class attractions, shopping, and diverse culinary experiences.
            </p>

            <!-- Price -->
            <p class="text-2xl font-bold text-blue-600 mb-1">
                From IDR 1,200,000
            </p>

            <!-- Highlights -->
            <ul class="text-sm text-gray-600 space-y-1 my-4">
                <p class="text-lg font-semibold my-2">Highlights:</p>
                <li>🌆 Iconic city skyline & attractions</li>
                <li>🛍️ World-class shopping districts</li>
                <li>🍽️ Multicultural cuisine</li>
                <li>🚇 Clean, safe & efficient transport</li>
            </ul>

            <!-- Ideal For -->
            <div class="text-sm text-gray-600 mb-4">
                <p class="font-semibold mb-1">Ideal for:</p>
                <p>Short city trips, business travel, family vacations</p>
            </div>

            <!-- CTA -->
            <a href="{{ route('flights.index', ['to' => 'SIN']) }}"
            class="mt-auto block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Search Flights
            </a>
        </div>
    </div>

    {{-- Card 2: Jakarta → Kuala Lumpur --}}
    <div class="min-h-[65vh] bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
        <!-- Image -->
        <img src="/images/kualalumpur_img.jpg" class="w-full h-72 object-cover">

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">

            <!-- Badge -->
            <span class="px-3 py-1 bg-blue-600 text-white text-xs rounded-full mb-3 inline-block w-fit">
                International
            </span>

            <!-- Destination -->
            <h5 class="text-xl font-semibold mb-1">
                Jakarta → Kuala Lumpur (CGK → KUL)
            </h5>
            <p class="text-gray-500 mb-3">
                A vibrant capital city blending modern skyscrapers with rich cultural heritage.
            </p>

            <!-- Price -->
            <p class="text-2xl font-bold text-blue-600 mb-1">
                From IDR 900,000
            </p>

            <!-- Highlights -->
            <ul class="text-sm text-gray-600 space-y-1 my-4">
                <p class="text-lg font-semibold my-2">Highlights:</p>
                <li>🏙️ Petronas Twin Towers & city landmarks</li>
                <li>🕌 Cultural diversity & heritage sites</li>
                <li>🍛 Affordable food & shopping</li>
                <li>🚕 Easy city transportation</li>
            </ul>

            <!-- Ideal For -->
            <div class="text-sm text-gray-600 mb-4">
                <p class="font-semibold mb-1">Ideal for:</p>
                <p>Budget travelers, cultural exploration, short holidays</p>
            </div>

            <!-- CTA -->
            <a href="{{ route('flights.index', ['to' => 'KUL']) }}"
            class="mt-auto block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Search Flights
            </a>
        </div>
    </div>

    {{-- Card 3: Jakarta → Bangkok --}}
    <div class="min-h-[65vh] bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition flex flex-col">
        <!-- Image -->
        <img src="/images/bangkok_img.jpg" class="w-full h-72 object-cover">

        <!-- Content -->
        <div class="p-6 flex flex-col flex-1">

            <!-- Badge -->
            <span class="px-3 py-1 bg-blue-600 text-white text-xs rounded-full mb-3 inline-block w-fit">
                International
            </span>

            <!-- Destination -->
            <h5 class="text-xl font-semibold mb-1">
                Jakarta → Bangkok (CGK → BKK)
            </h5>
            <p class="text-gray-500 mb-3">
                A lively metropolis known for its temples, street food, and exciting nightlife.
            </p>

            <!-- Price -->
            <p class="text-2xl font-bold text-blue-600 mb-1">
                From IDR 1,500,000
            </p>

            <!-- Highlights -->
            <ul class="text-sm text-gray-600 space-y-1 my-4">
                <p class="text-lg font-semibold my-2">Highlights:</p>
                <li>🛕 Stunning temples & historical sites</li>
                <li>🍜 Famous street food scene</li>
                <li>🛍️ Night markets & shopping malls</li>
                <li>🌃 Vibrant nightlife & entertainment</li>
            </ul>

            <!-- Ideal For -->
            <div class="text-sm text-gray-600 mb-4">
                <p class="font-semibold mb-1">Ideal for:</p>
                <p>Food lovers, cultural explorers, urban adventurers</p>
            </div>
            @endforeach

            <!-- CTA -->
            <a href="{{ route('flights.index', ['to' => 'BKK']) }}"
            class="mt-auto block w-full text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Search Flights
            </a>
        </div>
    </div>

</div>
    </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="h-screen snap-start flex flex-col justify-center bg-gray-50">
        <div class="container mx-auto px-20">

            <!-- Heading -->
            <div class="text-center mb-16">
                <h1 class="text-4xl font-bold mb-4">
                    Why Choose Us
                </h1>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Designed with transparency, performance, and smart decision-making
                    to help you book flights with confidence.
                </p>
            </div>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Real-Time Data -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition
                            flex flex-col justify-between
                            min-h-[20vh] md:min-h-[40vh] lg:min-h-[50vh]">

                    <!-- TOP -->
                    <div>
                        <!-- Icon -->
                        <div class="text-blue-600 mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <!-- Title -->
                        <h5 class="text-xl font-semibold mb-4">
                            Real-Time Flight Data
                        </h5>

                        <!-- Description -->
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Our system connects directly to airline databases to deliver
                            accurate prices and seat availability in real time.
                        </p>

                        <!-- Bullet points -->
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Live fare updates with no delay
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Real seat availability from airlines
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Eliminates price changes at checkout
                            </li>
                        </ul>
                    </div>

                    <!-- BOTTOM -->
                    <div class="pt-6 border-t">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Updated every few seconds</span>
                            <span class="text-green-600 font-medium">System Active</span>
                        </div>
                    </div>
                </div>


                <!-- Transparent Pricing -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition
                            flex flex-col justify-between
                            min-h-[20vh] md:min-h-[40vh] lg:min-h-[50vh]">

                    <!-- TOP -->
                    <div>
                        <div class="text-blue-600 mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 1.343-3 3m6 0a3 3 0 00-3-3m0 6h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>

                        <h5 class="text-xl font-semibold mb-4">
                            Transparent Pricing
                        </h5>

                        <p class="text-gray-600 leading-relaxed mb-6">
                            All flight prices are displayed clearly with a complete cost breakdown
                            before you proceed to booking.
                        </p>

                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                No hidden fees or surprise charges
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Taxes and service fees shown upfront
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Accurate total price at checkout
                            </li>
                        </ul>
                    </div>

                    <!-- BOTTOM -->
                    <div class="pt-6 border-t">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Pricing verified</span>
                            <span class="text-green-600 font-medium">No Hidden Fees</span>
                        </div>
                    </div>
                </div>

                <!-- Smart Flight Ranking -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition
                            flex flex-col justify-between
                            min-h-[20vh] md:min-h-[40vh] lg:min-h-[50vh]">

                    <!-- TOP -->
                    <div>
                        <div class="text-blue-600 mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2a4 4 0 014-4h2M9 5h6M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>

                        <h5 class="text-xl font-semibold mb-4">
                            Smart Flight Ranking
                        </h5>

                        <p class="text-gray-600 leading-relaxed mb-6">
                            Our decision-support system analyzes multiple factors to recommend
                            the most suitable flights for your needs.
                        </p>

                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Ranked by price, duration, and convenience
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Emission-aware flight comparisons
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                No sponsored or biased results
                            </li>
                        </ul>
                    </div>

                    <!-- BOTTOM -->
                    <div class="pt-6 border-t">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Decision support enabled</span>
                            <span class="text-blue-600 font-medium">Smart Ranking</span>
                        </div>
                    </div>
                </div>

                <!-- Secure & Reliable System -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition
                            flex flex-col justify-between
                            min-h-[20vh] md:min-h-[40vh] lg:min-h-[50vh]">

                    <!-- TOP -->
                    <div>
                        <div class="text-blue-600 mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c1.104 0 2 .896 2 2v2a2 2 0 11-4 0v-2c0-1.104.896-2 2-2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 11V7a5 5 0 00-10 0v4"/>
                            </svg>
                        </div>

                        <h5 class="text-xl font-semibold mb-4">
                            Secure & Reliable System
                        </h5>

                        <p class="text-gray-600 leading-relaxed mb-6">
                            Your personal and payment information is protected by modern
                            security standards and reliable system infrastructure.
                        </p>

                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Encrypted data transmission
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                Secure payment processing
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-blue-600 mt-1">✔</span>
                                High system uptime and reliability
                            </li>
                        </ul>
                    </div>

                    <!-- BOTTOM -->
                    <div class="pt-6 border-t">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>System uptime</span>
                            <span class="text-green-600 font-medium">99.9%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-16">
                <a href="{{ route('flights.index') }}"
                class="inline-block px-10 py-4 bg-blue-600 text-white font-semibold rounded-xl shadow-lg hover:bg-blue-700 transition">
                    Find Your Flight
                </a>
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
