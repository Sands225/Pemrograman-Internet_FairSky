@extends('layouts.app')

@section('title', 'Login')

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
                    <h3 class="text-center my-4 fw-bold">Log In Your Account</h3>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="text-end">
                                {{-- <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a> --}}
                                <a href="#" class="text-decoration-none">Forgot Password?</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-semibold mt-4">Login</button>
                    </form>

                    <div class="text-center my-3">
                        {{-- <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a> --}}
                        <p> Don't have an account? <a href="#" class="text-decoration-none">Register Now!</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
