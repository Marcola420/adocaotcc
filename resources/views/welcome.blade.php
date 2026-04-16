@php use Illuminate\Support\Str; @endphp

<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>ONG Animais</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card img {
            object-fit: cover;
            height: 200px;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .hero {
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
            color: white;
            padding: 40px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">🐶 ONG Animais</a>

        <div class="ms-auto">
            @auth
                <a href="/admin/dashboard" class="btn btn-warning btn-sm">Admin</a>
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger btn-sm">Sair</button>
                </form>
            @else
                <a href="/login" class="btn btn-light btn-sm">Login</a>
                <a href="/register" class="btn btn-primary btn-sm">Cadastro</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-4">

    <!-- HERO -->
    <div class="hero text-center">
        <h1>🐾 Encontre seu novo melhor amigo</h1>
        <p>Adote, não compre. Dê uma nova chance para um animal ❤️</p>
    </div>

    <!-- FILTRO -->
    <form method="GET" class="mb-4 d-flex gap-2">
        <select name="tipo" class="form-select w-25">
            <option value="">Todos</option>
            <option value="cachorro">Cachorros</option>
            <option value="gato">Gatos</option>
        </select>
        <button class="btn btn-primary">Filtrar</button>
    </form>

    <!-- LISTA -->
    <div class="row">

        @forelse($pets as $pet)
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">

                    @if($pet->foto)
                        <img src="{{ asset('storage/' . $pet->foto) }}">
                    @else
                        <img src="https://via.placeholder.com/300x200">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $pet->nome }}</h5>

                        <p class="text-muted">
                            {{ ucfirst($pet->tipo) }} • {{ $pet->idade }} anos
                        </p>

                        <p class="card-text">
                            {{ Str::limit($pet->descricao, 80) }}
                        </p>

                        <a href="/adotar/{{ $pet->id }}" class="btn btn-success w-100">
                            Quero Adotar ❤️
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <p>Nenhum pet encontrado 😢</p>
        @endforelse

    </div>

</div>

</body>
</html>