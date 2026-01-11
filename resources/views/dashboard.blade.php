<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin/dashboard">Admin Panel</a>
        <div class="d-flex">
            <a href="/" class="btn btn-outline-light btn-sm me-2">Sajt</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <h1 class="mb-4">Dashboard</h1>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Korisnici</h6>
                    <h2 class="fw-bold">{{ \App\Models\User::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Porudžbine</h6>
                    <h2 class="fw-bold">{{ \App\Models\Order::count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Proizvodi</h6>
                    <h2 class="fw-bold">{{ \App\Models\Product::count() }}</h2>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-5">

    <div class="d-flex flex-wrap gap-3">
        <a href="{{ route('users.index') }}" class="btn btn-primary">Upravljanje korisnicima</a>
        <a href="{{ route('orders.index') }}" class="btn btn-success">Pregled porudžbina</a>
        <a href="{{ route('products.index') }}" class="btn btn-warning">Proizvodi</a>
    </div>

</div>

</body>
</html>
