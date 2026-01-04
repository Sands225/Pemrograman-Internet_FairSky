@extends('layouts.app')

@section('title', 'Passenger Details')

@section('content')
<div class="container mx-auto max-w-6xl py-10 mt-[60px] grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- ================= LEFT SIDE (FORM) ================= --}}
    <div class="lg:col-span-2 space-y-6">

        {{-- STEP INDICATOR --}}
        <div class="flex items-center text-sm text-gray-500 gap-4">
            <span class="font-semibold text-blue-600">1. Pilih Penerbangan</span>
            <span>→</span>
            <span class="font-semibold text-blue-600">2. Data Penumpang</span>
            <span>→</span>
            <span>3. Pembayaran</span>
        </div>

        <h1 class="text-2xl font-bold text-gray-800 my-6">
            Data Penumpang
        </h1>

        <form method="POST"
              action="{{ route('bookings.create', ['flightId' => $flightClass->flight_id, 'flightClassId' => $flightClass->id]) }}"
              class="bg-white rounded-xl shadow p-6 space-y-8">
            @csrf

            {{-- ================= PASSENGER ================= --}}
            <h2 class="text-lg font-bold border-b pb-2">Data Penumpang</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <select name="passenger_title" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">Pilih</option>
                        <option value="MR">MR</option>
                        <option value="MRS">MRS</option>
                        <option value="MS">MS</option>
                    </select>
                </div>

                <div class="md:col-span-3">
                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" name="passenger_name" required
                           placeholder="Sesuai KTP / Paspor"
                           class="w-full border rounded-lg px-4 py-2">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Tipe Penumpang</label>
                <select name="passenger_type" required class="w-full border rounded-lg px-4 py-2">
                    <option value="adult">Dewasa</option>
                    <option value="child">Anak</option>
                    <option value="infant">Bayi</option>
                </select>
            </div>

            {{-- ================= CONTACT ================= --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="email" name="passenger_email" required
                       placeholder="Email"
                       class="w-full border rounded-lg px-4 py-2">

                <input type="text" name="passenger_phone" required
                       placeholder="No. Telepon"
                       class="w-full border rounded-lg px-4 py-2">
            </div>

            {{-- ================= ADDITIONAL SERVICES ================= --}}
            <h2 class="text-lg font-bold border-b pb-2">Layanan Tambahan</h2>

            {{-- BAGGAGE --}}
            <div class="border rounded-lg p-4 space-y-2">
                <h3 class="font-semibold">Bagasi Tambahan</h3>
                <select id="extra_baggage" name="extra_baggage"
                        class="w-full border rounded-lg px-4 py-2">
                    <option value="0" data-price="0">Tidak tambah bagasi</option>
                    <option value="5" data-price="150000">+5 kg — IDR 150.000</option>
                    <option value="10" data-price="275000">+10 kg — IDR 275.000</option>
                    <option value="20" data-price="500000">+20 kg — IDR 500.000</option>
                </select>
            </div>

            {{-- MEAL --}}
            <div class="border rounded-lg p-4 space-y-2">
                <h3 class="font-semibold">Pilihan Makanan</h3>

                <label class="flex items-center gap-2 text-sm">
                    <input type="radio" name="meal" value="none" data-price="0" checked>
                    Tidak memilih makanan
                </label>

                <label class="flex items-center gap-2 text-sm">
                    <input type="radio" name="meal" value="standard" data-price="50000">
                    Makanan Standar — IDR 50.000
                </label>

                <label class="flex items-center gap-2 text-sm">
                    <input type="radio" name="meal" value="vegetarian" data-price="60000">
                    Vegetarian — IDR 60.000
                </label>
            </div>

            {{-- INSURANCE --}}
            <div class="border rounded-lg p-4">
                <label class="flex items-start gap-3 text-sm">
                    <input type="checkbox" id="insurance" name="insurance" value="1" data-price="35000">
                    <span>
                        Tambahkan Asuransi Perjalanan<br>
                        <span class="text-gray-500">(+ IDR 35.000)</span>
                    </span>
                </label>
            </div>

            {{-- CONFIRM --}}
            <label class="flex items-start gap-2 text-sm">
                <input type="checkbox" required class="mt-1">
                Saya menyatakan data sudah benar
            </label>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold">
                Lanjutkan ke Pembayaran
            </button>
        </form>
    </div>

    {{-- ================= RIGHT SIDE (SUMMARY) ================= --}}
    <div class="bg-white rounded-xl shadow p-6 h-fit sticky top-24 space-y-4">

        <h3 class="font-bold text-lg">Ringkasan Penerbangan</h3>

        <div class="text-sm">
            <p class="font-semibold">
                {{ $flightClass->flight->airline->airline_name }}
                ({{ $flightClass->flight->flight_number ?? '-' }})
            </p>
            <p>
                {{ $flightClass->flight->originAirport->airport_code }}
                →
                {{ $flightClass->flight->destinationAirport->airport_code }}
            </p>
            <p class="text-gray-500">
                {{ \Carbon\Carbon::parse($flightClass->flight->departure_time)->translatedFormat('d F Y, H:i') }}
            </p>
        </div>

        <hr>

        <div id="addons-summary" class="hidden text-sm space-y-1">
            <p class="font-semibold">Layanan Tambahan</p>
            <div id="addons-list" class="text-gray-600"></div>
        </div>

        <hr>

        <div class="flex justify-between items-center">
            <span>Total Harga</span>
            <span class="font-bold text-lg">
                IDR <span id="total-price">{{ number_format($flightClass->price,0,',','.') }}</span>
            </span>
        </div>
    </div>
</div>

{{-- ================= JAVASCRIPT ================= --}}
<script>
    const basePrice = {{ $flightClass->price }};
    const addonsList = document.getElementById('addons-list');
    const addonsSummary = document.getElementById('addons-summary');
    const totalPriceEl = document.getElementById('total-price');

    function formatIDR(num) {
        return num.toLocaleString('id-ID');
    }

    function updateSummary() {
        let total = basePrice;
        addonsList.innerHTML = '';

        // BAGGAGE
        const baggage = document.getElementById('extra_baggage');
        const baggageOption = baggage.options[baggage.selectedIndex];
        const baggagePrice = parseInt(baggageOption.dataset.price);

        if (baggage.value > 0) {
            addonsList.innerHTML += `<p>Bagasi +${baggage.value}kg <span class="float-right">IDR ${formatIDR(baggagePrice)}</span></p>`;
            total += baggagePrice;
        }

        // MEAL
        const meal = document.querySelector('input[name="meal"]:checked');
        const mealPrice = parseInt(meal.dataset.price);

        if (meal.value !== 'none') {
            addonsList.innerHTML += `<p>Makanan (${meal.value}) <span class="float-right">IDR ${formatIDR(mealPrice)}</span></p>`;
            total += mealPrice;
        }

        // INSURANCE
        const insurance = document.getElementById('insurance');
        if (insurance.checked) {
            const price = parseInt(insurance.dataset.price);
            addonsList.innerHTML += `<p>Asuransi <span class="float-right">IDR ${formatIDR(price)}</span></p>`;
            total += price;
        }

        addonsSummary.classList.toggle('hidden', addonsList.innerHTML === '');
        totalPriceEl.innerText = formatIDR(total);
    }

    document.getElementById('extra_baggage').addEventListener('change', updateSummary);
    document.querySelectorAll('input[name="meal"]').forEach(el => el.addEventListener('change', updateSummary));
    document.getElementById('insurance').addEventListener('change', updateSummary);

    updateSummary();
</script>
@endsection
