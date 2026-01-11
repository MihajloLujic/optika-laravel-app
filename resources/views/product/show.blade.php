<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }}</title>

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

<div class="container mt-5">

    <div class="row">

        <!-- SLIKA -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <img src="https://via.placeholder.com/600x400?text=Optika"
                     class="card-img-top"
                     alt="{{ $product->name }}">
            </div>
        </div>

        <!-- DETALJI -->
        <div class="col-md-6">
            <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

            <p class="fs-4 fw-bold text-primary mb-3">
                {{ $product->price }} RSD
            </p>

            <p class="mb-4">
                {{ $product->description ?? 'Opis proizvoda trenutno nije dostupan.' }}
            </p>

            <div class="mb-3">
                <strong>Kategorija:</strong>
                {{ $product->category->name ?? 'Nema kategorije' }}
            </div>

            <div class="mb-4">
                <strong>Dostupno na stanju:</strong>
                {{ $product->stock }}
            </div>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button class="btn btn-success btn-lg">
                Dodaj u korpu
            </button>
            </form>

        </div>

    </div>

</div>

</body>
</html>
