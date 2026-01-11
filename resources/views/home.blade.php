<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Optika</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .brand-big {
            font-size: 28px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- LEVO: OPTIKA -->
        <a class="navbar-brand brand-big" href="{{ route('home') }}">Optika</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- DESNO -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Početna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products">Ponuda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">O nama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontakt</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{ route('cart.index') }}">
                            🛒 Korpa
                            @if(session('cart') && count(session('cart')) > 0)
                                ({{ count(session('cart')) }})
                            @endif
                        </a>
                    </li>
                @endauth


                @guest
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">Prijava</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Registracija</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item ms-3">
                        <a class="btn btn-danger btn-sm" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Izloguj se
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<div class="container mt-5">

    <!-- NASLOV -->
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="fw-bold">Katalog</h1>
            <p class="text-muted">Izdvojeni proizvodi iz naše ponude</p>
        </div>
    </div>

    <!-- PROIZVODI - CENTRIRANI -->
    <div class="row justify-content-center">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm text-center">
                    <img src="https://via.placeholder.com/300x200?text=Optika"
                         class="card-img-top"
                         alt="{{ $product->name }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold">{{ $product->price }} RSD</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
 n