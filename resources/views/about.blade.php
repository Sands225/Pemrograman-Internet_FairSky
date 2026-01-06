@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- HERO SECTION --}}
<!-- <section class="bg-gradient-to-b from-gray-800 to-gray-900 py-20 bg-cover bg-center relative" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('images/homepage_airplane_bg.jpeg') }}'); background-attachment: fixed;">
    <div class="container mx-auto px-4 text-center">
        <img src="{{ asset('images/logo.png') }}" alt="FairSky Logo" class="mx-auto h-40 mb-8">
        <h1 class="text-4xl font-bold text-white">About FairSky</h1>
    </div>
</section> -->

{{-- THE ORIGIN STORY --}}
<section class="py-16 pt-24 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            {{-- Image --}}
            <div class="order-2 lg:order-1">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-80 rounded-2xl shadow-lg"></div>
            </div>

            {{-- Content --}}
            <div class="order-1 lg:order-2">
                <h2 class="text-3xl font-bold mb-4">The Origin Story</h2>
                <p class="text-gray-600 leading-relaxed">
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
                <p class="text-gray-600 leading-relaxed">
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
            <div>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-80 rounded-2xl shadow-lg"></div>
            </div>

        </div>
    </div>
</section>

{{-- ENVIRONMENT PARTNER --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">
        
        <h2 class="text-3xl font-bold text-center mb-10">Environment Partner</h2>

        {{-- Partner Logos --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-32 rounded-xl shadow flex items-center justify-center hover:shadow-lg transition">
                <span class="text-white font-bold text-lg">Partner 1</span>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-32 rounded-xl shadow flex items-center justify-center hover:shadow-lg transition">
                <span class="text-white font-bold text-lg">Partner 2</span>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-32 rounded-xl shadow flex items-center justify-center hover:shadow-lg transition">
                <span class="text-white font-bold text-lg">Partner 3</span>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 h-32 rounded-xl shadow flex items-center justify-center hover:shadow-lg transition">
                <span class="text-white font-bold text-lg">Partner 4</span>
            </div>
        </div>

        {{-- Description --}}
        <p class="text-gray-600 leading-relaxed text-center">
            We're proud to partner with leading environmental organizations to offset carbon emissions and promote sustainable 
            aviation practices. Through our partnerships with global carbon offset programs, reforestation initiatives, and 
            clean energy projects, every flight booked through FairSky contributes to a greener future. Our partners help us 
            calculate accurate carbon footprints for each flight and provide verified offset options. Together, we're working 
            toward a goal of making air travel more environmentally responsible while maintaining the convenience and accessibility 
            that modern travelers need.
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

{{-- JOIN SMART TRAVELERS --}}
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <p class="text-2xl md:text-3xl font-semibold text-center text-gray-800 max-w-3xl mx-auto">
            Join thousands of smart travelers who choose honesty above all else.
        </p>
    </div>
</section>

@endsection