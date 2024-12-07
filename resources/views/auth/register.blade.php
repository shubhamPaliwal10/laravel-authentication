@extends('layouts.app')

@section('title', 'Register')

@section('custom_styles')
<style>
    .register-container {
        max-width: 500px;
        margin: auto;
        padding: 2rem;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .google-signup {
        background-color: #db4a39;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .google-signup i {
        margin-right: 0.5rem;
    }
    .login-link {
        text-align: center;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="register-container mt-5">
        <h2 class="text-center">Register</h2>
        {{-- <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6 mb-3">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="form-group col-lg-6 mb-3">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form> --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6 mb-3">
                    <label for="first_name">First Name</label>
                    <input 
                        type="text" 
                        class="form-control @error('first_name') is-invalid @enderror" 
                        id="first_name" 
                        name="first_name" 
                        value="{{ old('first_name') }}" 
                        required
                    >
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-lg-6 mb-3">
                    <label for="last_name">Last Name</label>
                    <input 
                        type="text" 
                        class="form-control @error('last_name') is-invalid @enderror" 
                        id="last_name" 
                        name="last_name" 
                        value="{{ old('last_name') }}" 
                        required
                    >
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6 mb-3">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        autocomplete="false"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-lg-6 mb-3">
                    <label for="mobile">Mobile</label>
                    <input 
                        type="text" 
                        class="form-control @error('mobile') is-invalid @enderror" 
                        id="mobile" 
                        name="mobile" 
                        value="{{ old('mobile') }}" 
                        required
                        autocomplete="false"
                    >
                    @error('mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    required
                    autocomplete="false"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>        
        <button class="btn google-signup w-100 mt-3" onclick="window.location.href='{{ route('auth.google') }}'">
            <i class="fab fa-google"></i> Sign Up with Google
        </button>
        <div class="login-link mt-3">
            <a href="{{ route('login') }}">Already registered? Login</a>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    
</script>
@endsection
