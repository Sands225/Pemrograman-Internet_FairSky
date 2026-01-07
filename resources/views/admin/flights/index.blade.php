@extends('admin.layouts.dashboard')

@section('title', 'Admin Overview')

@section('content')
<div class="min-h-[calc(100vh-5rem)] bg-gray-50">
    <div class="container mx-auto max-w-7xl px-6 py-10">

        {{-- Header --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Welcome back
                </h1>
                <p class="text-gray-500 mt-1">
                    Flight Management Dashboard
                </p>
            </div>
        </div>

        {{-- Flights Table --}}
        <div class="bg-white rounded-xl shadow-sm p-6">

            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-4">
                <h3 class="text-lg font-semibold">Flight Overview</h3>

                <div class="flex gap-3 w-full sm:w-auto">
                    {{-- Search --}}
                    <form method="GET" action="{{ route('admin.flights.index') }}" class="flex gap-2">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search flights..."
                            class="px-3 py-2 border rounded-lg text-sm w-64 focus:outline-none focus:ring focus:border-blue-300"
                        >

                        <button type="submit"
                                class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-900">
                            Search
                        </button>

                        @if(request('search'))
                            <a href="{{ route('admin.flights.index') }}"
                               class="px-4 py-2 bg-gray-200 text-sm rounded-lg hover:bg-gray-300">
                                Clear
                            </a>
                        @endif
                    </form>

                    {{-- Add Flight --}}
                    <a href="{{ route('admin.flights.create') }}"
                       class="px-4 py-2 bg-blue-600 hover:bg-blue-700 transition text-white text-sm rounded-lg">
                        + Add Flight
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600 text-center">
                        <tr>
                            <th class="p-3 font-medium">ID</th>
                            <th class="p-3 font-medium">Flight</th>
                            <th class="p-3 font-medium">Route</th>
                            <th class="p-3 font-medium">Status</th>
                            <th class="p-3 font-medium">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y text-center">
                        @forelse ($getAllFlights as $flight)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-gray-600">{{ $flight->id }}</td>

                                <td class="p-3 font-medium text-gray-800 text-left">
                                    {{ $flight->airline->airline_name ?? '-' }}
                                </td>

                                <td class="p-3 text-gray-600">
                                    {{ $flight->originAirport->airport_code ?? '?' }}
                                    →
                                    {{ $flight->destinationAirport->airport_code ?? '?' }}
                                </td>

                                <td class="p-3">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        {{ $flight->status ?? 'Unknown' }}
                                    </span>
                                </td>

                                <td class="p-3 flex gap-2 justify-center">
                                    <a href="{{ route('admin.flights.edit', $flight->id) }}"
                                       class="text-blue-600 hover:underline text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.flights.delete', $flight->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this flight?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-gray-500">
                                    No flights found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $getAllFlights->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
