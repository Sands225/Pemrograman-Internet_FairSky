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

        {{-- Flights Table --}}
        <div class="bg-white rounded-xl shadow-sm p-6">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Flight Overview</h3>

                <a href="{{ route('admin.flights.create') }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 transition text-white text-sm rounded-lg">
                    + Add Flight
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="p-3 font-medium">ID</th>
                            <th class="p-3 font-medium">Flight</th>
                            <th class="p-3 font-medium">Route</th>
                            <th class="p-3 font-medium">Status</th>
                            <th class="p-3 font-medium">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        {{-- rows --}}
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection

