<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Upravljanje korisnicima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand fw-bold">Admin – Korisnici</span>
        <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">Nazad na dashboard</a>
    </div>
</nav>

<div class="container">

    <h1 class="mb-4">Upravljanje korisnicima</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <h5 class="mb-3">Dodaj novog korisnika</h5>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" placeholder="Ime" required>
                </div>

                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="col-md-3">
                    <input type="password" name="password" class="form-control" placeholder="Lozinka (min 8)" required>
                </div>

                <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_admin" id="is_admin">
                        <label class="form-check-label" for="is_admin">
                            Admin
                        </label>
                    </div>
                </div>

                <div class="col-md-1">
                    <button class="btn btn-success w-100">+</button>
                </div>
            </div>
        </form>
    </div>
</div>


    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Ime</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th class="text-end">Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="badge bg-success">ADMIN</span>
                                @else
                                    <span class="badge bg-secondary">Korisnik</span>
                                @endif
                            </td>
                            <td class="text-end">
                                @if(!$user->is_admin)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Da li si siguran da želiš da obrišeš korisnika?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Obriši</button>
                                    </form>
                                @else
                                    <span class="text-muted">Zaštićen</span>
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
