<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f5f6f8; }
    </style>
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">🧾 Checkout</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    <div class="row">

        <!-- FORMA -->
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Podaci za dostavu</h5>

                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Ime i prezime</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Adresa</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefon</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Potvrdi porudžbinu
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- PREGLED KORPE -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Tvoja korpa</h5>

                    <ul class="list-group mb-3">
                        @php $total = 0; @endphp

                        @foreach($cart as $item)
                            @php $total += $item['price'] * $item['quantity']; @endphp
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $item['name'] }} <br>
                                    <small class="text-muted">Količina: {{ $item['quantity'] }}</small>
                                </div>
                                <span>{{ $item['price'] * $item['quantity'] }} RSD</span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between fw-bold">
                            <span>UKUPNO:</span>
                            <span>{{ $total }} RSD</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
