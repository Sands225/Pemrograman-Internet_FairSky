<aside class="fixed inset-y-0 left-0 w-64
              bg-slate-900 text-slate-200 shadow-xl">

    {{-- Logo --}}
    <div class="h-16 flex items-center justify-center border-b border-slate-700">
        <span class="text-xl font-extrabold tracking-wide text-white">
            ✈ FairSky
        </span>
    </div>

    {{-- Navigation --}}
    <nav class="p-4 space-y-6">

        {{-- OVERVIEW --}}
        <div>
            <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                Overview
            </p>

            <x-admin.nav-link
                route="admin.dashboard"
                icon="📊"
                label="Dashboard" />
        </div>

        <div class="border-t border-slate-700"></div>

        {{-- MANAGEMENT --}}
        <div>
            <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                Management
            </p>

            <x-admin.nav-link
                route="admin.flights.index"
                icon="✈️"
                label="Flights" />
        </div>

    </nav>
</aside>
