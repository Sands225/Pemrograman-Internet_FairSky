@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<style>
    .results-wrapper {
        background: url('/images/homepage_airplane_bg.jpeg');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        padding-top: 120px;
        padding-bottom: 80px;
        font-family: 'Poppins', sans-serif;
    }

    .results-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        max-width: 1100px;
        margin: auto;
        box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
    }

    .flight-card {
        border-radius: 18px;
        border: 1px solid #e5e5e5;
        padding: 25px;
        transition: .2s;
    }

    .flight-card:hover {
        box-shadow: 0px 8px 20px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }

    .airline-badge {
        font-size: 14px;
        padding: 5px 12px;
        border-radius: 10px;
        background: #eef3ff;
        color: #1a73e8;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #0d6efd !important;
        border-radius: 12px;
        padding: 10px 20px;
        font-weight: 600;
    }
</style>

<div class="results-wrapper">
    <div class="results-card">

        <!-- TITLE -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">Available Flights</h2>
            <p class="text-muted">
                Showing results for 
                <strong>{{ $from }}</strong> ➝ <strong>{{ $to }}</strong>  
                on <strong>{{ $date }}</strong>
            </p>
        </div>

        <!-- FLIGHT LIST -->
        @foreach ($flights as $flight)
        <div class="flight-card mb-3">

            <div class="row align-items-center">
                
                <!-- Airline + Number -->
                <div class="col-md-3">
                    <span class="airline-badge">{{ $flight->airline }}</span>
                    <p class="mt-2 mb-0 text-secondary">{{ $flight->flight_number }}</p>
                </div>

                <!-- Times -->
                <div class="col-md-4 text-center">
                    <h5 class="fw-bold mb-0">{{ $flight->departure_time }}</h5>
                    <small class="text-muted">{{ $flight->from_airport }}</small>

                    <p class="my-1">✈</p>

                    <h5 class="fw-bold mb-0">{{ $flight->arrival_time }}</h5>
                    <small class="text-muted">{{ $flight->to_airport }}</small>
                </div>

                <!-- Price -->
                <div class="col-md-3 text-center">
                    <h4 class="fw-bold text-primary">
                        Rp {{ number_format($flight->price, 0, ',', '.') }}
                    </h4>
                    <p class="text-muted mb-0">{{ $flight->duration }} hours</p>
                </div>

                <!-- Button -->
                <div class="col-md-2 text-end">
                    <a href="{{ route('flights.book', $flight->id) }}" class="btn btn-primary">
                        Select
                    </a>
                </div>

            </div>

        </div>
        @endforeach

    </div>
</div>

@endsection
