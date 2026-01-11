<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Porudžbine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">Admin – Porudžbine</span>
        <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">Nazad na dashboard</a>
    </div>
</nav>

<div class="container">

    <h1 class="mb-4">Pregled porudžbina</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover mb-0">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Korisnik</th>
            <th>Proizvod</th>
            <th>Ime i prezime</th>
            <th>Adresa</th>
            <th>Telefon</th>
            <th>Ukupno</th>
            <th>Status</th>
            <th>Akcija</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->email ?? 'N/A' }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->full_name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->total }} RSD</td>

                <td>
                    <span class="badge 
                        @if($order->status == 'pending') bg-warning text-dark 
                        @elseif($order->status == 'paid') bg-success 
                        @elseif($order->status == 'cancelled') bg-danger 
                        @endif
                    ">
                        {{ strtoupper($order->status) }}
                    </span>
                </td>

                <td>
                    <div class="d-flex gap-1">
                        <form action="{{ route('orders.pending', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-warning btn-sm">Pending</button>
                        </form>

                        <form action="{{ route('orders.paid', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Paid</button>
                        </form>

                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-danger btn-sm">Cancel</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


        </div>
    </div>

</div>

</body>
</html>
