@extends('admin.layouts.dashboard')

@section('title', 'Edit Flight')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Edit Flight</h1>

    <form method="POST"
          action="{{ route('admin.flights.edit', $flight->id) }}"
          class="space-y-5">
        @csrf

        {{-- Flight Number --}}
        <div>
            <label class="block text-sm font-medium">Flight Number</label>
            <input type="text"
                   name="flight_number"
                   value="{{ old('flight_number', $flight->flight_number) }}"
                   class="w-full border rounded p-2">
            @error('flight_number') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Airline --}}
        <select name="airline_id"
                id="airline"
                class="w-full border rounded p-2"
                required>
            <option value="">-- Select Airline --</option>
            {{-- @foreach ($flight->airlines as $airline) --}}
                <option value="{{ $flight->airline->id }}"
                    @selected(old('airline_id', $flight->airline_id) == $flight->airline->id)>
                    {{ $flight->airline->airline_name }}
                </option>
            {{-- @endforeach --}}
        </select>
        @error('airline_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        {{-- Airplane --}}
        <select name="airplane_id"
                id="airplane"
                class="w-full border rounded p-2">
            <option>Loading airplanes...</option>
        </select>
        @error('airplane_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        {{-- Route --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Origin Airport</label>
                <select name="origin_airport_id" class="w-full border rounded p-2">
                    {{-- @foreach ($airports as $airport) --}}
                        <option value="{{ $flight->originAirport->id }}"
                            @selected(old('origin_airport_id', $flight->origin_airport_id) == $flight->originAirport->id)>
                            {{ $flight->originAirport->airport_code }}
                        </option>
                    {{-- @endforeach --}}
                </select>
                @error('origin_airport_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Destination Airport</label>
                <select name="destination_airport_id" class="w-full border rounded p-2">
                    {{-- @foreach ($airports as $airport) --}}
                        <option value="{{ $flight->destinationAirport->id }}"
                            @selected(old('destination_airport_id', $flight->destination_airport_id) == $flight->destinationAirport->id)>
                            {{ $flight->destinationAirport->airport_code }}
                        </option>
                    {{-- @endforeach --}}
                </select>
                @error('destination_airport_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Schedule --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Departure Time</label>
                <input type="datetime-local"
                       name="departure_time"
                       value="{{ old('departure_time', \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d\TH:i')) }}"
                       class="w-full border rounded p-2">
                @error('departure_time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Arrival Time</label>
                <input type="datetime-local"
                       name="arrival_time"
                       value="{{ old('arrival_time', \Carbon\Carbon::parse($flight->arrival_time)->format('Y-m-d\TH:i')) }}"
                       class="w-full border rounded p-2">
                @error('arrival_time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-medium">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="Scheduled"
                    @selected(old('status', $flight->status) === 'Scheduled')>
                    Scheduled
                </option>
                <option value="Delayed"
                    @selected(old('status', $flight->status) === 'Delayed')>
                    Delayed
                </option>
                <option value="Cancelled"
                    @selected(old('status', $flight->status) === 'Cancelled')>
                    Cancelled
                </option>
            </select>
            @error('status')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 pt-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Update Flight
            </button>
            <a href="{{ route('admin.flights.index') }}"
               class="px-4 py-2 border rounded">
                Cancel
            </a>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const airlineSelect = document.getElementById('airline');
    const airplaneSelect = document.getElementById('airplane');
    const selectedAirplaneId = "{{ old('airplane_id', $flight->airplane_id) }}";

    function loadAirplanes(airlineId) {
        airplaneSelect.innerHTML = '<option>Loading...</option>';

        fetch(`/admin/airlines/${airlineId}/airplanes`)
            .then(res => res.json())
            .then(airplanes => {
                airplaneSelect.innerHTML = '<option value="">Select Airplane</option>';

                airplanes.forEach(airplane => {
                    const option = document.createElement('option');
                    option.value = airplane.id;
                    option.text =
                        `${airplane.model} (${airplane.total_capacity} seats)`;

                    if (airplane.id == selectedAirplaneId) {
                        option.selected = true;
                    }

                    airplaneSelect.appendChild(option);
                });
            })
            .catch(() => {
                airplaneSelect.innerHTML = '<option>Error loading airplanes</option>';
            });
    }

    // Load airplanes on page load
    if (airlineSelect.value) {
        loadAirplanes(airlineSelect.value);
    }

    // Reload when airline changes
    airlineSelect.addEventListener('change', function () {
        if (this.value) {
            loadAirplanes(this.value);
        }
    });
});
</script>
@endsection
