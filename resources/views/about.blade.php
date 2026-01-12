<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>O nama | Optika</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

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
                    <a class="nav-link" href="{{ route('public.products.index') }}">Ponuda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">O nama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Kontakt</a>
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
<div class="container py-5">

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="fw-bold mb-3">O nama</h1>
            <p class="lead">
                Dobrodošli u našu optičarsku radnju – mesto gde se kvalitet, stil i briga o vašem vidu spajaju.
            </p>
            <p>
                Naša optika posluje već više od 10 godina i nudi širok asortiman dioptrijskih i sunčanih naočara,
                kontaktnih sočiva i prateće opreme. Sarađujemo sa poznatim svetskim brendovima i garantujemo kvalitet
                svakog proizvoda.
            </p>
            <p>
                Naš stručni tim je tu da vam pomogne u izboru idealnih naočara koje odgovaraju vašim potrebama i stilu.
            </p>
        </div>
        <div class="col-md-6 text-center">
            <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5" class="img-fluid rounded shadow" alt="Optika">
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-4">
            <h4 class="fw-bold">✔ Kvalitet</h4>
            <p>Provereni brendovi i sertifikovani proizvodi.</p>
        </div>
        <div class="col-md-4">
            <h4 class="fw-bold">✔ Iskustvo</h4>
            <p>Više od decenije uspešnog rada sa klijentima.</p>
        </div>
        <div class="col-md-4">
            <h4 class="fw-bold">✔ Podrška</h4>
            <p>Ljubazno osoblje i stručni saveti.</p>
        </div>
    </div>

</div>

<footer class="bg-light text-secondary text-center py-4 mt-5 border-top">
    <p class="mb-1 fw-semibold">Optika</p>
    <p class="mb-0 small">
        © {{ date('Y') }} Sva prava zadržana.
    </p>
</footer>



</body>
</html>
