<aside class="fixed inset-y-0 left-0 w-64
              bg-slate-900 text-slate-200 shadow-xl flex flex-col">

    {{-- Logo --}}
    <div class="h-[5rem] flex items-center border-b border-slate-700 py-8 px-4">
        <span class="text-xl font-extrabold tracking-wide text-white">
            <img src="{{ asset('images/logo.png') }}" alt="FairSky Logo" class="w-40 inline-block">
        </span>
    </div>

    {{-- MAIN NAVIGATION --}}
    <nav class="p-4 space-y-6 text-sm flex-1">

        {{-- OVERVIEW --}}
        <div>
            <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
                Overview
            </p>

            <x-admin.nav-link
                route="admin.dashboard"
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
                label="Flights" />
        </div>

    </nav>

    {{-- PROFILE --}}
    <div class="p-4 border-t border-slate-700 text-sm">

        <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
            Profile
        </p>

        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf

            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2 rounded-lg transition
                       text-red-400 hover:bg-slate-800 hover:text-red-300">
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>
