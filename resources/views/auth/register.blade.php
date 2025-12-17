@extends('layouts.app')

@section('title', 'Register')

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
<div class="hero-section min-h-screen bg-black/30 bg-blend-darken flex justify-center items-center px-4 pt-28 pb-10">

    {{-- REGISTER CARD --}}
    <div class="w-full max-w-md bg-white/90 backdrop-blur shadow-2xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
            Create Your Account
        </h2>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            {{-- FULL NAME --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 
                    @error('full_name') border-red-500 @enderror"
                    value="{{ old('full_name') }}" required>
                @error('full_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 
                    @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 
                    @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="mb-3">
                <label class="block text-sm font-semibold text-gray-700 mb-2" for="password_confirmation">
                    Confirm Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            {{-- BUTTON --}}
            <button type="submit"
                class="w-full mt-5 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow-lg transition">
                Register
            </button>
        </form>

        {{-- LOGIN LINK --}}
        <div class="text-center mt-5 text-sm">
            <p>
                Already have an account?
                <a href="{{ route('auth.login') }}" class="text-blue-600 font-semibold hover:underline">
                    Login Now
                </a>
            </p>
        </div>

    </div>
</div>

@endsection