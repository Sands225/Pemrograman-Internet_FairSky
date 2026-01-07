@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- THE ORIGIN STORY --}}
<section class="py-16 pt-24 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            {{-- Image --}}
            <div class="order-2 lg:order-1">
                <div class="h-80 rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{ asset('images/about_plane.jpg') }}"
                        alt="FairSky Origin"
                        class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Content --}}
            <div class="order-1 lg:order-2">
                <h2 class="text-3xl font-bold mb-4">The Origin Story</h2>
                <p class="text-gray-600 leading-relaxed text-justify">
                    FairSky was born from a simple yet powerful idea: air travel should be transparent, fair, and accessible to everyone. 
                    We noticed that booking flights often came with hidden fees, confusing pricing structures, and a lack of clarity 
                    about the environmental impact of each journey. Our founders, a team of travel enthusiasts and tech innovators, 
                    set out to change this. We built FairSky to provide travelers with complete pricing transparency, real-time flight 
                    data, and carbon footprint calculations—all in one platform. Our mission is to empower you to make informed decisions 
                    that align with both your budget and your values.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- BUSINESS TRANSPARENCY --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            {{-- Content --}}
            <div>
                <h2 class="text-3xl font-bold mb-4">Business Transparency</h2>
                <p class="text-gray-600 leading-relaxed text-justify">
                    At FairSky, transparency isn't just a buzzword—it's the foundation of everything we do. We believe that travelers 
                    deserve to know exactly what they're paying for, without any hidden surprises at checkout. That's why we break down 
                    every cost component: base fare, taxes, service fees, and baggage charges—all displayed upfront before you book. 
                    We don't accept commissions from airlines to rank certain flights higher, and we never manipulate search results 
                    for profit. Our revenue model is simple: we earn a small service fee for each booking, which is clearly stated 
                    during the payment process. This approach ensures that our recommendations are always based on what's best for you, 
                    not what's most profitable for us.
                </p>
            </div>

            {{-- Image --}}
            <div class="order-2 lg:order-1">
                <div class="h-80 rounded-2xl shadow-lg overflow-hidden">
                    <img src="{{ asset('images/about_market-research.png') }}"
                        alt="Market Research"
                        class="w-full h-full object-cover">
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ENVIRONMENT PARTNER --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <h2 class="text-3xl font-bold text-center mb-10">
            Environment Partners
        </h2>

        {{-- Partner Logos --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10 items-center">

            <div class="flex items-center justify-center bg-gray-50 h-32 rounded-xl shadow 
                        hover:shadow-lg transition">
                <img src="{{ asset('images/partners/gold-standard.png') }}"
                     alt="Gold Standard"
                     class="h-14 object-contain">
            </div>

            <div class="flex items-center justify-center bg-gray-50 h-32 rounded-xl shadow 
                        hover:shadow-lg transition">
                <img src="{{ asset('images/partners/verra.png') }}"
                     alt="Verra"
                     class="h-14 object-contain">
            </div>

            <div class="flex items-center justify-center bg-gray-50 h-32 rounded-xl shadow 
                        hover:shadow-lg transition">
                <img src="{{ asset('images/partners/atmosfair.png') }}"
                     alt="atmosfair"
                     class="h-14 object-contain">
            </div>

            <div class="flex items-center justify-center bg-gray-50 h-32 rounded-xl shadow 
                        hover:shadow-lg transition">
                <img src="{{ asset('images/partners/nature-conservacy.png') }}"
                     alt="The Nature Conservancy"
                     class="h-14 object-contain">
            </div>

        </div>

        {{-- Description --}}
        <p class="text-gray-600 leading-relaxed text-center max-w-4xl mx-auto">
            FairSky aligns with globally recognized environmental organizations and sustainability standards
            to support responsible aviation. Through certified carbon offset programs, reforestation initiatives,
            and clean energy projects, every flight booked through our platform contributes toward reducing
            environmental impact.
            <br><br>
            These initiatives help ensure accurate carbon footprint calculations and provide travelers with
            transparent, trusted options to make more environmentally conscious travel decisions—without
            sacrificing convenience or accessibility.
        </p>

        {{-- Disclaimer --}}
        <p class="text-sm text-gray-400 text-center mt-6">
            Logos shown represent sustainability standards and initiatives aligned with FairSky’s mission.
        </p>

    </div>
</section>

{{-- READY TO EXPLORE --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-8 leading-tight">
            Ready To Explore in a Better Way?
        </h2>

        <a href="{{ route('flights.index') }}" 
           class="inline-flex items-center gap-2 px-10 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Explore Flights
        </a>

    </div>
</section>

@endsection