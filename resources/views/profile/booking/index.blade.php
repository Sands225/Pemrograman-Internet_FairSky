<?php

@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Purchase List</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                {{-- SIDEBAR --}}
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
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
                            <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-xl transition">
                                <span>👤</span> Profile Settings
                            </a>
                            <a href="{{ route('bookings.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-blue-600 bg-blue-50 rounded-xl transition">
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

                {{-- DAFTAR PESANAN --}}
                <main class="flex-1">
                    <div class="space-y-4">
                        @forelse($bookings as $booking)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                                <div class="flex flex-col md:flex-row justify-between gap-6">
                                    {{-- Info Penerbangan --}}
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="text-xs font-bold px-2 py-1 bg-blue-100 text-blue-700 rounded uppercase">Flight</span>
                                            <span class="text-xs text-gray-400">ID Pesanan: {{ $booking->booking_code }}</span>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            @if($booking->logo_url)
                                                <img src="{{ $booking->logo_url }}" class="w-10 h-10 object-contain">
                                            @endif
                                            <div>
                                                <p class="font-bold text-gray-800">{{ $booking->origin_city }} → {{ $booking->destination_city }}</p>
                                                <p class="text-sm text-gray-500">{{ $booking->airline_name }} • {{ \Carbon\Carbon::parse($booking->departure_time)->format('d M Y') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Status & Aksi --}}
                                    <div class="flex flex-row md:flex-col justify-between items-end border-t md:border-t-0 md:border-l border-gray-50 pt-4 md:pt-0 md:pl-6">
                                        <div class="text-right">
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $booking->status == 'Completed' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                            {{ $booking->status }}
                                        </span>
                                            <p class="text-lg font-bold text-blue-600 mt-1">IDR {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="#" class="text-sm font-bold text-blue-600 hover:underline">Detail Pesanan</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white rounded-2xl p-12 text-center border border-gray-100">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl">🎫</div>
                                <h3 class="text-lg font-bold text-gray-800">Belum ada pesanan</h3>
                                <p class="text-gray-500 text-sm mt-1">Tiket pesawat yang Anda beli akan muncul di sini.</p>
                                <a href="{{ route('flights.index') }}" class="inline-block mt-6 bg-blue-600 text-white font-bold px-8 py-3 rounded-xl hover:bg-blue-700 transition">Cari Penerbangan</a>
                            </div>
                        @endforelse
                    </div>
                </main>
            </div>
        </div>
    </div>
@endsection
