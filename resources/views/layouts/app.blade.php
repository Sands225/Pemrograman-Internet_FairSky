<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkyWings Aviation')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('css')

    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Poppins', 'sans-serif'],
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 font-sans">

{{-- NAVIGATION --}}
<nav class="bg-white shadow-sm fixed top-0 inset-x-0 z-50 py-3">
    <div class="container mx-auto px-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="{{ route('home') }}">
            <img src="/images/logo.png" class="w-24" alt="logo">
        </a>

        {{-- Mobile Button --}}
        <button id="mobileMenuBtn" class="lg:hidden text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center space-x-8">
            <a href="/flights" class="text-gray-600 hover:text-blue-600 transition">Flights</a>
            <a href="#about" class="text-gray-600 hover:text-blue-600 transition">About Us</a>
            <a href="#contact" class="text-gray-600 hover:text-blue-600 transition">Help</a>
        </div>

        {{-- Auth --}}
        <div class="hidden lg:flex items-center">
            @if(session()->has('user_id'))
                <span class="mr-3 font-semibold text-gray-700">
                    Hi, {{ session('user_name') }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 border border-red-500 text-red-500 rounded 
                        hover:bg-red-500 hover:text-white transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('auth.login') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Login
                </a>
            @endif
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="hidden lg:hidden mt-4 pb-4 px-4">
        <div class="flex flex-col space-y-3">
            <a href="/flights" class="text-gray-600 hover:text-blue-600 transition">Flights</a>
            <a href="#about" class="text-gray-600 hover:text-blue-600 transition">About Us</a>
            <a href="#contact" class="text-gray-600 hover:text-blue-600 transition">Help</a>

            @if(session()->has('user_id'))
                <span class="font-semibold text-gray-700">Hi, {{ session('user_name') }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full px-4 py-2 border border-red-500 text-red-500 rounded 
                        hover:bg-red-500 hover:text-white transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('auth.login') }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center transition">
                    Login
                </a>
            @endif
        </div>
    </div>

</nav>

{{-- MAIN CONTENT --}}
<main class="">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-gray-900 text-white pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">

            {{-- Logo --}}
            <div>
                <img src="/images/logo.png" class="w-24 mb-4" alt="logo">
                <p class="text-gray-400">
                    Your trusted aviation partner for flights, charters, and training.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h6 class="font-bold mb-4">Quick Links</h6>
                <ul class="space-y-2 text-gray-400">
                    <li>—</li>
                </ul>
            </div>

            {{-- Company --}}
            <div>
                <h6 class="font-bold mb-4">Company</h6>
                <ul class="space-y-2 text-gray-400">
                    <li>—</li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h6 class="font-bold mb-4">Contact</h6>
                <p class="text-gray-400">Email: info@skywings.com</p>
                <p class="text-gray-400">Phone: +1 (555) 123-4567</p>
            </div>
        </div>

        <hr class="border-gray-700 mb-6">

        <p class="text-center text-gray-400">
            &copy; 2024 SkyWings Aviation. All rights reserved.
        </p>
    </div>
</footer>

{{-- JS --}}
<script>
    document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    });
</script>

@yield('js')

</body>
</html>