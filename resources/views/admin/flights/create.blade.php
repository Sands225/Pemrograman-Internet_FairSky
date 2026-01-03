@extends('admin.layouts.dashboard')

@section('title', 'Create Flight')

@section('content')
<div class="max-w-3xl mx-auto py-10">

    <h1 class="text-2xl font-bold mb-6">Create Flight</h1>

    <form method="POST" action="{{ route('admin.flights.create') }}" class="space-y-5">
        @csrf

        {{-- Flight Number --}}
        <div>
            <label class="block text-sm font-medium">Flight Number</label>
            <input type="text"
                   name="flight_number"
                   value="{{ old('flight_number') }}"
                   placeholder="GA-102"
                   class="w-full border rounded p-2">
            @error('flight_number') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Airline --}}
        <select name="airline_id"
                id="airline"
                class="w-full border rounded p-2"
                required>
            <option value="">-- Select Airline --</option>
            @foreach ($airlines as $airline)
                <option value="{{ $airline->id }}">
                    {{ $airline->airline_name }}
                </option>
            @endforeach
        </select>

        {{-- Airplane --}}
        <select name="airplane_id"
                id="airplane"
                class="w-full border rounded p-2"
                disabled>
            <option>-- Select Airline First --</option>
        </select>

        {{-- Route --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Origin Airport</label>
                <select name="origin_airport_id" class="w-full border rounded p-2">
                    @foreach ($airports as $airport)
                        <option value="{{ $airport->id }}"
                            @selected(old('origin_airport_id') == $airport->id)>
                            {{ $airport->airport_code }}
                        </option>
                    @endforeach
                </select>
                @error('origin_airport_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Destination Airport</label>
                <select name="destination_airport_id" class="w-full border rounded p-2">
                    @foreach ($airports as $airport)
                        <option value="{{ $airport->id }}"
                            @selected(old('destination_airport_id') == $airport->id)>
                            {{ $airport->airport_code }}
                        </option>
                    @endforeach
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
                       value="{{ old('departure_time') }}"
                       class="w-full border rounded p-2">
                @error('departure_time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium">Arrival Time</label>
                <input type="datetime-local"
                       name="arrival_time"
                       value="{{ old('arrival_time') }}"
                       class="w-full border rounded p-2">
                @error('arrival_time') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Price --}}
        <div>
            <label class="block text-sm font-medium">Base Price (IDR)</label>
            <input type="number"
                   name="base_price"
                   min="0"
                   value="{{ old('base_price') }}"
                   class="w-full border rounded p-2">
            @error('base_price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 pt-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Save Flight
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
document.getElementById('airline').addEventListener('change', function () {
    const airlineId = this.value;
    const airplaneSelect = document.getElementById('airplane');

    airplaneSelect.innerHTML = '<option>Loading...</option>';
    airplaneSelect.disabled = true;

    if (!airlineId) {
        airplaneSelect.innerHTML = '<option>Select Airline First</option>';
        return;
    }

    fetch(`/admin/airlines/${airlineId}/airplanes`)
        .then(response => response.json())
        .then(airplanes => {
            airplaneSelect.innerHTML = '<option value="">Select Airplane</option>';

            airplanes.forEach(airplane => {
                airplaneSelect.innerHTML += `
                    <option value="${airplane.id}">
                        ${airplane.model} (${airplane.total_capacity} seats)
                    </option>
                `;
            });

            airplaneSelect.disabled = false;
        })
        .catch(() => {
            airplaneSelect.innerHTML = '<option>Error loading airplanes</option>';
        });
});
</script>
@endsection
