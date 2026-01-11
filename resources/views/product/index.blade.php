<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Ponuda</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Optika</a>

        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Početna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/products">Ponuda</a>
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

<div class="container mt-5">

    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="fw-bold">Ponuda</h1>
            <p class="text-muted">Pogledajte sve proizvode iz naše ponude</p>
        </div>
    </div>

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm text-center">
                    <img src="https://via.placeholder.com/300x200?text=Optika"
                         class="card-img-top"
                         alt="{{ $product->name }}">

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold">{{ $product->price }} RSD</p>
                        <a href="/products/{{ $product->id }}" class="btn btn-outline-primary btn-sm">Pogledaj</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>
