<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Proizvodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">Admin – Proizvodi</span>
        <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">Nazad na dashboard</a>
    </div>
</nav>

<div class="container">

    <h1 class="mb-4">Pregled proizvoda</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Naziv</th>
                        <th>Cena</th>
                        <th>Na stanju</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }} RSD</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success">IMA</span>
                                @else
                                    <span class="badge bg-danger">NEMA</span>
                                @endif
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
