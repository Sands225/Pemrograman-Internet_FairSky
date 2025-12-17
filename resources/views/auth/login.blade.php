@extends('layouts.app')

@section('title', 'Login')

@section('css')
<style>
.hero-section {
    background-image: url('{{ asset('images/homepage_airplane_bg.jpeg') }}');
    background-size: cover;
    background-position: center;
}
</style>
@endsection

@section('content')

{{-- FULL PAGE WRAPPER --}}
<div class="hero-section h-screen bg-black/30 bg-blend-darken flex justify-center items-center px-4">

    {{-- LOGIN CARD --}}
    <div class="w-full max-w-md bg-white/90 backdrop-blur shadow-2xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Log In Your Account
        </h2>

        {{-- ERROR --}}
        @if (session('error'))
            <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            {{-- EMAIL --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Email</label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       required autofocus
                       class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3">
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       required
                       class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div class="text-right mt-2">
                    <a href="#" class="text-blue-600 text-sm hover:underline">Forgot Password?</a>
                </div>
            </div>

            {{-- LOGIN BUTTON --}}
            <button type="submit"
                class="w-full mt-6 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow-lg transition">
                Login
            </button>
        </form>

        {{-- REGISTER --}}
        <div class="text-center mt-5 text-sm">
            <p>
                Don't have an account?
                <a href="{{ route('auth.register') }}" class="text-blue-600 font-semibold hover:underline">
                    Register Now!
                </a>
            </p>
        </div>

    </div>
</div>

@endsection
