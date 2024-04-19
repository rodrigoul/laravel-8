<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 8 - Lista de Compras</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body class="antialiased">
    <div class="container d-flex flex-column align-items-center justify-content-center vh-100">
        <h2>Laravel - Lista de Compras</h2>
        <i class="fas fa-cart-plus fa-10x mb-4"></i>
        @if (Route::has('login'))
        <div class="links">
            @auth
            <a href="{{ url('home') }}" class="btn btn-primary btn-sm me-2">Home</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm me-2">Entrar</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Registrar</a>
            @endif
            @endauth
        </div>
        @endif
    </div>
    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
