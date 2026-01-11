<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Korpa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f5f6f8; }
    </style>
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">🛒 Korpa</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info">
            Korpa je prazna.
        </div>
        <a href="/products" class="btn btn-primary">Nazad na ponudu</a>
    @else
        <table class="table table-bordered bg-white shadow-sm">
            <thead>
                <tr>
                    <th>Proizvod</th>
                    <th>Cena</th>
                    <th>Količina</th>
                    <th>Ukupno</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp

                @foreach($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }} RSD</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['price'] * $item['quantity'] }} RSD</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm">Ukloni</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <th colspan="3" class="text-end">UKUPNO:</th>
                    <th>{{ $total }} RSD</th>
                    <th></th>
                </tr>
            </tbody>
        </table>

        <a href="/products" class="btn btn-secondary">Nastavi kupovinu</a>

        <a href="{{ route('checkout.index') }}" class="btn btn-success ms-2">
            Završi kupovinu
        </a>


    @endif

</div>

</body>
</html>
