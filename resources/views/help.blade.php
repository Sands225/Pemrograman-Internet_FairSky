@extends('layouts.app')

@section('title', 'Help Center')

@section('content')

<div class="bg-gray-50 min-h-screen pt-24 pb-10">
    <div class="container mx-auto px-4 max-w-6xl">

        {{-- Page Title --}}
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Help Center</h1>
        <p class="text-lg text-gray-600 mb-12">Find answers to common questions about FairSky</p>

        {{-- FAQ Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">Frequently Asked Questions</h2>

            <div class="space-y-6">

                {{-- FAQ 1 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> How do I search for flights?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        On the home page, fill in your departure city, destination, travel dates, and number of passengers. Click "Search Flights" to see available options ranked by our smart system considering price, duration, and carbon footprint.
                    </p>
                </div>

                {{-- FAQ 2 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> Are there any hidden fees?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        No! At FairSky, we believe in complete transparency. All fees including taxes, service charges, and baggage fees are displayed upfront before you complete your booking. What you see is what you pay.
                    </p>
                </div>

                {{-- FAQ 3 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> How do I book a flight?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        After selecting your flight, you'll be taken to the booking page where you can enter passenger details. Review all information carefully, then proceed to payment. You'll receive a confirmation email with your booking details.
                    </p>
                </div>

                {{-- FAQ 4 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> What payment methods do you accept?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        We accept major credit cards, debit cards, and various digital payment methods. All transactions are secured with encryption to protect your payment information.
                    </p>
                </div>

                {{-- FAQ 5 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> Can I modify or cancel my booking?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        Modifications and cancellations depend on the airline's policy and your ticket type. Log in to your account under "My Bookings" to view your options or contact our support team for assistance.
                    </p>
                </div>

                {{-- FAQ 6 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> What is the carbon footprint feature?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        Our system calculates the estimated carbon emissions for each flight. This helps you make environmentally conscious choices and understand the environmental impact of your travel decision.
                    </p>
                </div>

                {{-- FAQ 7 --}}
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> How do I reset my password?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        On the login page, click "Forgot Password" and enter your email address. You'll receive a password reset link that you can use to create a new password.
                    </p>
                </div>

                {{-- FAQ 8 --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-blue-600">Q:</span> How can I contact customer support?
                    </h3>
                    <p class="text-gray-600 ml-6">
                        You can reach our support team via email at <strong>support@fairsky.com</strong> or call <strong>+1 (555) 123-4567</strong>. We're available 24/7 to assist you.
                    </p>
                </div>

            </div>
        </div>

        {{-- Contact Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Email Support</h3>
                <p class="text-gray-600 mb-4">support@fairsky.com</p>
                <p class="text-sm text-gray-500">Response within 24 hours</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Phone Support</h3>
                <p class="text-gray-600 mb-4">+1 (555) 123-4567</p>
                <p class="text-sm text-gray-500">Available 24/7</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                <div class="text-blue-600 mb-4 flex justify-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Live Chat</h3>
                <p class="text-gray-600 mb-4">Chat with our team</p>
                <p class="text-sm text-gray-500">9 AM - 6 PM EST</p>
            </div>

        </div>

        {{-- CTA --}}
        <div class="bg-blue-600 rounded-2xl p-8 text-center text-white">
            <h2 class="text-2xl font-bold mb-4">Still Need Help?</h2>
            <p class="mb-6 text-blue-100">Our support team is ready to assist you</p>
            <a href="mailto:support@fairsky.com" class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition">
                Contact Support
            </a>
        </div>

    </div>
</div>

@endsection
