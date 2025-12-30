@extends('admin.layouts.dashboard')

@section('title', 'Admin Overview')

@section('content')
<div class="min-h-screen bg-gray-50 pt-[60px]">

    <div class="container mx-auto max-w-7xl px-6 py-10">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Welcome back 👋
                </h1>
                <p class="text-gray-500 mt-1">
                    Performance Summary — {{ now()->format('d F Y') }}
                </p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            {{-- Revenue --}}
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Overall Revenue</p>
                    <span class="text-green-500 text-xl">💰</span>
                </div>
                <h2 class="text-3xl font-bold mt-3">Rp 1.500.000</h2>
                <p class="text-green-600 text-sm mt-1">▲ 5% than previously</p>
            </div>

            {{-- Tickets --}}
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Tickets Revenue</p>
                    <span class="text-blue-500 text-xl">🎟</span>
                </div>
                <h2 class="text-3xl font-bold mt-3">Rp 100.000.000</h2>
                <p class="text-green-600 text-sm mt-1">▲ 15% more tickets</p>
            </div>

            {{-- Offset --}}
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Offset Revenue</p>
                    <span class="text-purple-500 text-xl">🌱</span>
                </div>
                <h2 class="text-3xl font-bold mt-3">Rp 50.000.000</h2>
                <p class="text-blue-600 text-sm mt-1">Ready to distribute</p>
            </div>

        </div>

        {{-- Graph + Notifications --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

            {{-- Graph --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-semibold mb-4">Performance (Last 30 Days)</h3>
                <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400">
                    Chart Placeholder
                </div>
            </div>

            {{-- Alerts --}}
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-semibold mb-4">Alerts</h3>
                <ul class="space-y-3 text-sm">
                    <li>🔔 Revenue increased 5%</li>
                    <li>🔔 Ticket sales up 15%</li>
                    <li>🔔 JKT → Bali fully booked</li>
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection

