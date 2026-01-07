@extends('admin.layouts.dashboard')

@section('title', 'Admin Overview')

@section('content')
<div class="min-h-[calc(100vh-5rem)] bg-gray-50">

    <div class="container mx-auto max-w-7xl px-6 py-10">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Welcome back
            </h1>
            <p class="text-gray-500 mt-1">
                Performance Summary
            </p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            {{-- Overall Revenue --}}
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <p class="text-sm text-gray-500">Overall Revenue</p>
                <h2 class="text-3xl font-bold mt-3">
                    Rp {{ number_format($overallRevenue, 0, ',', '.') }}
                </h2>
                <p class="text-green-600 text-sm mt-1">
                    Paid transactions
                </p>
            </div>

            {{-- Ticket Revenue --}}
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <p class="text-sm text-gray-500">Tickets Revenue</p>
                <h2 class="text-3xl font-bold mt-3">
                    Rp {{ number_format($ticketRevenue, 0, ',', '.') }}
                </h2>
                <p class="text-green-600 text-sm mt-1">
                    Paid tickets
                </p>
            </div>

            {{-- Offset / Add-ons --}}
            <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-500">Offset Revenue</p>
                </div>
                <h2 class="text-3xl font-bold mt-3">
                    Rp {{ number_format($offsetRevenue, 0, ',', '.') }}
                </h2>
                <p class="text-blue-600 text-sm mt-1">
                    Add-ons & offsets
                </p>
            </div>


        </div>

        {{-- Graph + Alerts --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Key Numbers --}}
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-semibold mb-6">Key Numbers</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Total Flights --}}
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Total Flights</p>
                        <p class="text-2xl font-bold text-gray-800">
                            {{ $totalFlights }}
                        </p>
                    </div>

                    {{-- Total Tickets --}}
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Tickets Sold</p>
                        <p class="text-2xl font-bold text-gray-800">
                            {{ $totalTickets }}
                        </p>
                    </div>

                    {{-- Active Routes --}}
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-xs text-gray-500 mb-1">Active Routes</p>
                        <p class="text-2xl font-bold text-gray-800">
                            {{ $activeRoutes }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Alerts --}}
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-semibold mb-4">Top Routes</h3>
                <ul class="space-y-2 text-sm">
                    @forelse($routes as $route)
                        <li>
                            {{ $route->origin }} → {{ $route->destination }} <br>
                            ({{ $route->total }} flights)
                        </li>
                    @empty
                        <li class="text-green-600">
                            All routes operational
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($performance->pluck('date'));
    const data = @json($performance->pluck('total'));

    if (labels.length) {
        new Chart(document.getElementById('performanceChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: data,
                    tension: 0.4,
                    fill: true
                }]
            }
        });
    }
</script>
@endpush
