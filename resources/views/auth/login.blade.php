@extends('layouts.app')

@section('title', 'Login')

@section('custom_styles')
<style>
    .login-container {
        max-width: 500px;
        margin: auto;
        padding: 2rem;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .google-login {
        background-color: #db4a39;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .google-login i {
        margin-right: 0.5rem;
    }
    .forgot-password,
    .register-link {
        text-align: center;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="login-container mt-5">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <button class="btn google-login w-100 mt-3" onclick="window.location.href='{{ route('auth.google') }}'">
            <i class="fab fa-google"></i> Login with Google
        </button>
    </div>
</div>
@endsection

@section('custom_scripts')
<script>
    // Custom scripts if needed
</script>
@endsection
