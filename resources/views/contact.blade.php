<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Kontakt | Optika</title>
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

    <div class="row mb-5">
        <div class="col-md-6">
            <h1 class="fw-bold mb-3">Kontaktirajte nas</h1>
            <p class="mb-4">
                Imate pitanje, sugestiju ili vam je potrebna pomoć? Slobodno nam pišite.
            </p>

            <form>
                <div class="mb-3">
                    <label class="form-label">Ime i prezime</label>
                    <input type="text" class="form-control" placeholder="Unesite ime i prezime">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Unesite email adresu">
                </div>

                <div class="mb-3">
                    <label class="form-label">Poruka</label>
                    <textarea class="form-control" rows="5" placeholder="Unesite vašu poruku"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Pošalji poruku</button>
            </form>
        </div>

        <div class="col-md-6">
            <h4 class="fw-bold mb-3">Naši podaci</h4>
            <p><strong>Adresa:</strong> Bulevar kralja Aleksandra 123, Beograd</p>
            <p><strong>Telefon:</strong> 011/123-4567</p>
            <p><strong>Email:</strong> info@optika.rs</p>

            <div class="mt-4">
                <iframe
                    src="https://maps.google.com/maps?q=Belgrade&t=&z=13&ie=UTF8&iwloc=&output=embed"
                    width="100%"
                    height="300"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy">
                </iframe>
            </div>
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
