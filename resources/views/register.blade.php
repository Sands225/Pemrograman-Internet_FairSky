@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    .plane-background {
        background: url('/images/homepage_airplane_bg.jpeg');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .transparent-card {
        background-color: rgba(255, 255, 255, 0.90);
    }
</style>

<div class="container-fluid d-flex flex-column justify-content-center plane-background pt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card shadow-lg transparent-card" style="border-radius: 15px;">
                <div class="card-body p-4">

                    <h3 class="text-center my-4 fw-bold">Create Your Account</h3>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-semibold mt-3">
                            Register
                        </button>
                    </form>

                    <div class="text-center my-3">
                        <p>Already have an account?
                            <a href="{{ route('login.page') }}" class="text-decoration-none">Login here</a>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
