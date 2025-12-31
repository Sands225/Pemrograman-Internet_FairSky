@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="flex flex-col lg:flex-row gap-8">

                {{-- SIDEBAR PROFIL --}}
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 bg-blue-600 text-white">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center font-bold text-xl">
                                    {{ substr($user->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold leading-tight">{{ $user->full_name }}</p>
                                    <p class="text-xs text-blue-100 mt-1">Bronze Priority</p>
                                </div>
                            </div>
                        </div>
                        <nav class="p-2">
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-blue-600 bg-blue-50 rounded-xl transition">
                                <span>👤</span> Account Information
                            </a>
                            <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-xl transition">
                                <span>🎫</span> My Bookings
                            </a>
                            <hr class="my-2 border-gray-50">
                            <form method="POST" action="{{ route('auth.logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 rounded-xl transition">
                                    <span>🚪</span> Logout
                                </button>
                            </form>
                        </nav>
                    </div>
                </aside>

                {{-- FORM EDIT PROFIL --}}
                <main class="flex-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h1 class="text-2xl font-bold text-gray-800 mb-2">Account Information</h1>
                        <p class="text-gray-500 text-sm mb-8">Update your account information here.</p>

                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            {{-- @method('PUT') --}}

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                                    <input type="text" name="full_name" value="{{ $user->full_name }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                                    <input type="email" name="email" value="{{ $user->email }}"
                                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                                    <p class="text-[10px] text-gray-400 mt-1 italic">*Email can not be changed due to security reason.</p>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="bg-blue-600 text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-95">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </main>

            </div>
        </div>
    </div>
@endsection
