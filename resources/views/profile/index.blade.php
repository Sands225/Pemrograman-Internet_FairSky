@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4 max-w-6xl">

            <h1 class="text-3xl font-bold text-gray-800 mb-8">Settings</h1>

            <div class="flex flex-col lg:flex-row gap-8">

                {{-- SIDEBAR PROFIL --}}
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                        <div class="p-6 bg-blue-600 text-white">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center font-bold text-xl">
                                    {{ substr($user->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold leading-tight">{{ $user->full_name }}</p>
                                    <p class="text-xs text-blue-100 mt-1">FairSky User</p>
                                </div>
                            </div>
                        </div>
                        <nav class="p-2">
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold {{ !request('tab') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-xl transition">
                                <span>👤</span> Profile Settings
                            </a>
                            <a href="{{ route('profile.bookings.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-xl transition">
                                <span>🎫</span> My Bookings
                            </a>
                            <hr class="my-2 border-gray-50">
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition text-left">
                                    <span>🚪</span> Logout
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                {{-- KONTEN UTAMA --}}
                <main class="flex-1">

                    <div class="flex border-b border-gray-200 mb-6 gap-8">
                        <a href="{{ route('profile.index') }}"
                           class="pb-4 text-sm font-bold transition-all {{ !request('tab') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Account Information
                        </a>
                        <a href="{{ route('profile.index', ['tab' => 'security']) }}"
                           class="pb-4 text-sm font-bold transition-all {{ request('tab') == 'security' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                            Password & Security
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 animate-fade-in">
                            <span>✅</span> {{ session('success') }}
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                        {{-- Account Information --}}
                        @if(!request('tab'))
                            <div class="p-8">
                                <h2 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b border-gray-50">Personal Data</h2>
                                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                                            <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                                   class="w-full px-4 py-3 rounded-xl border @error('full_name') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm">
                                            <p class="text-[10px] text-gray-400 mt-2 italic">Your full name will also appear as your profile name</p>
                                            @error('full_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                                            <input type="email" value="{{ $user->email }}"
                                                   class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-400 cursor-not-allowed shadow-sm" readonly>
                                        </div>
                                    </div>

                                    <div class="pt-6 flex justify-end gap-3 border-t border-gray-50 mt-8">
                                        <button type="button" class="px-6 py-2.5 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Maybe later</button>
                                        <button type="submit" class="bg-blue-600 text-white font-bold px-10 py-2.5 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-100 active:scale-95">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        {{-- Password & Security --}}
                        @if(request('tab') == 'security')
                            <div class="p-8">
                                <h2 class="text-lg font-bold text-gray-800 mb-6 pb-4 border-b border-gray-50">Account Security</h2>
                                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="tab" value="security">

                                    <div class="space-y-6 max-w-2xl">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Current Password</label>
                                            <input type="password" name="current_password"
                                                   class="w-full px-4 py-3 rounded-xl border @error('current_password') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm"
                                                   placeholder="Input your password">
                                            @error('current_password')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                                                <input type="password" name="new_password"
                                                       class="w-full px-4 py-3 rounded-xl border @error('new_password') border-red-500 @else border-gray-200 @enderror focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm"
                                                       placeholder="Minimum 8 characters">
                                                @error('new_password')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                                                <input type="password" name="new_password_confirmation"
                                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 outline-none transition shadow-sm"
                                                       placeholder="Repeat new password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-6 flex justify-end gap-3 border-t border-gray-50 mt-8">
                                        <button type="submit" class="bg-blue-600 text-white font-bold px-10 py-2.5 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-100 active:scale-95">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif

                    </div>
                </main>

            </div>
        </div>
    </div>
@endsection
