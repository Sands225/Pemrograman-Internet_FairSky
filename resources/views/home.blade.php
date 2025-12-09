@extends('layouts.app')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')

<div class="scroll-container">
<section class="landing-wrapper snap-section">

    <div class="container text-center mt-5 pt-4 text-white">
        <h1 class="fw-bold" style="text-shadow: 0 3px 8px rgba(0,0,0,0.5);">See Clearly, Fly Fairly</h1>
        <p class="fw-semibold" style="text-shadow: 0 2px 6px rgba(0,0,0,0.35);">SLOGAN</p>
    </div>

    {{-- HERO BOX --}}
    <div class="container">
        <div class="hero-box p-4 bg-white shadow rounded-4">

            <!-- Centered Form -->
            <form class="mx-auto" style="">

            <!-- Tabs -->
            <ul class="nav nav-pills justify-content-center mb-4">
                <li class="nav-item">
                    <button class="nav-link active px-3 py-1" type="button">
                        Round Trip
                    </button>
                </li>
                <li class="nav-item ms-2">
                    <button class="nav-link px-3 py-1" type="button">
                        One-Way Trip
                    </button>
                </li>
            </ul>

            <!-- Form Fields -->
            <div class="row g-3">

                <!-- From -->
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Where From?</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-geo-alt text-primary"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="LWO, Lviv" name="from">
                    </div>
                </div>

                <!-- To -->
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Where To?</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-geo text-primary"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="LHR, London" name="to">
                    </div>
                </div>

                <!-- Departure -->
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Departure</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-calendar-event text-primary"></i>
                        </span>
                        <input type="date" class="form-control" name="departure">
                    </div>
                </div>

                <!-- Return -->
                <div class="col-md-3">
                    <label class="form-label small fw-semibold text-muted">Return</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="bi bi-calendar-check text-primary"></i>
                        </span>
                        <input type="date" class="form-control" name="return_date">
                    </div>
                </div>
            
                <!-- Search Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5 py-2 fw-semibold rounded-3">
                        Search Flights
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>

<section class="container mt-5 mb-4 snap-section">

    <h1 class="fw-semibold mb-4">Discover Best Flight Choices</h1>

    <!-- Filter Buttons -->
    <div class="btn-group mb-4" role="group">
        <button id="btnDomestic" class="btn btn-primary">Domestic</button>
        <button id="btnInternational" class="btn btn-outline-primary">International</button>
    </div>

    <!-- DOMESTIC ROUTES -->
    <div id="domesticRoutes" class="row gy-4">

        <div class="col-md-4">
            <div class="card">
                <img src="/images/bali_img.jpeg" class="card-img-top" alt="" height="250px">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">One Way</span>
                    <span class="badge bg-primary mb-2 ml-2">Domestic</span>
                    <h5 class="card-title">Jakarta - Bali</h5>
                    <p>12 December 2025</p>
                    <p class="card-text">Rute domestik favorit dengan maskapai ramah lingkungan.</p>
                    <a href="#" class="btn btn-primary w-100">Lihat Penerbangan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="/images/bali_img.jpeg" class="card-img-top" alt="" height="250px">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">One Way</span>
                    <span class="badge bg-primary mb-2 ml-2">Domestic</span>
                    <h5 class="card-title">Jakarta - Bali</h5>
                    <p>12 December 2025</p>
                    <p class="card-text">Rute domestik favorit dengan maskapai ramah lingkungan.</p>
                    <a href="#" class="btn btn-primary w-100">Lihat Penerbangan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="/images/bali_img.jpeg" class="card-img-top" alt="" height="250px">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">One Way</span>
                    <span class="badge bg-primary mb-2 ml-2">Domestic</span>
                    <h5 class="card-title">Jakarta - Bali</h5>
                    <p>12 December 2025</p>
                    <p class="card-text">Rute domestik favorit dengan maskapai ramah lingkungan.</p>
                    <a href="#" class="btn btn-primary w-100">Lihat Penerbangan</a>
                </div>
            </div>
        </div>

    </div>

    <!-- INTERNATIONAL ROUTES -->
    <div id="internationalRoutes" class="row gy-4 d-none">

        <div class="col-md-4">
            <div class="card">
                <img src="/images/routes/jakarta_singapore.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">International</span>
                    <h5 class="card-title">Jakarta ➝ Singapore</h5>
                    <p class="card-text">Rute internasional cepat dengan maskapai emisi rendah.</p>
                    <a href="#" class="btn btn-primary w-100">Lihat Penerbangan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="/images/routes/jakarta_tokyo.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">International</span>
                    <h5 class="card-title">Jakarta ➝ Tokyo</h5>
                    <p class="card-text">Penerbangan ramah lingkungan ke destinasi favorit.</p>
                    <a href="#" class="btn btn-primary w-100">Lihat Penerbangan</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="/images/routes/bali_sydney.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <span class="badge bg-primary mb-2">International</span>
                    <h5 class="card-title">Bali ➝ Sydney</h5>
                    <p class="card-text">Rute favorit wisatawan dengan pengalaman nyaman.</p>
                    <a href="#" class="btn btn-primary w-100">Lihat Penerbangan</a>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="container mt-5 mb-5 snap-section">
    <h1 class="fw-semibold mb-4">Why Choose Us</h1>

    <div class="row gy-4">

        <div class="col-md-4">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Eco-Friendly Flights</h5>
                    <p class="card-text">Kami memprioritaskan maskapai rendah emisi untuk penerbangan berkelanjutan.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Transparent Pricing</h5>
                    <p class="card-text">Harga jelas tanpa biaya tersembunyi, sesuai komitmen "Fly Fairly".</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 p-3">
                <div class="card-body">
                    <h5 class="card-title">Smart & Fast Search</h5>
                    <p class="card-text">Cari rute terbaik berdasarkan harga, kecepatan, dan emisi karbon.</p>
                </div>
            </div>
        </div>

    </div>
</section>
</div>

@section('js')
<script src="{{ asset('js/home.js') }}"></script>
@endsection

@endsection
