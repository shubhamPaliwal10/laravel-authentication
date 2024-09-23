<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            background-color: white;
        }
        label{
            margin-bottom: 0px;
        }
    </style>
    @yield('custom_styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light py-0">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png'); }}" style="height: 72px;" class="d-inline-block align-top" alt="App Logo">
        </a>
        <div class="ml-auto">
            @auth
                <a href="{{ route('logout') }}" class="btn btn-sm btn-danger">Logout</a>
            @else
                @if(Request::is('login') || Request::is('register') || Request::is('/'))
                    <a href="{{ route('register') }}" class="btn btn-sm btn-info">Register</a>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Login</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Custom Scripts -->
    @yield('custom_scripts')
</body>
</html>
