<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SkyWings Aviation')</title>

    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    @yield('css')
</head>

<body class="">

{{-- Navigation Bar --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top pt-3 pb-3">
    <div class="container">

        {{-- Left Navigation : Logo --}}
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
            <img src="/images/logo.png" alt="" width="100px">
        </a>

        {{-- Toggle Button for Mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Middle Navigation : Links --}}
        <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
            <div class="position-absolute top-50 start-50 translate-middle d-none d-lg-flex">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#Flights">Bookings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Help</a>
                    </li>
                </ul>
            </div>

            {{-- Right Navigation : Login --}}
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <a href="{{ route('login') }}" class="btn btn-primary ms-2">
                    Login
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Main Content --}}
<main class="">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">

        <div class="row">

            <div class="col-md-3 mb-4">
                <img src="/images/logo.png" alt="" width="100px">
                <p class="text-secondary">
                    Your trusted aviation partner for flights, charters, and training.
                </p>
            </div>

            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Quick Links</h6>
                <ul class="list-unstyled text-secondary">
                    {{-- Add links here if needed --}}
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Company</h6>
                <ul class="list-unstyled text-secondary">
                    {{-- Add links here if needed --}}
                </ul>
            </div>

            <div class="col-md-3 mb-4">
                <h6 class="fw-bold mb-3">Contact</h6>
                <p class="text-secondary">Email: info@skywings.com</p>
                <p class="text-secondary">Phone: +1 (555) 123-4567</p>
            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center text-secondary">
            &copy; 2024 SkyWings Aviation. All rights reserved.
        </div>

    </div>
</footer>

{{-- JavaScript --}}
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>
@yield('js')

</body>
</html>
