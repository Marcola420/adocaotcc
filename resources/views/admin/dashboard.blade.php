<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h1 class="mb-4">📊 Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5>Total de Pets</h5>
                    <h2>{{ $pets }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5>Total de Adoções</h5>
                    <h2>{{ $adocoes }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5>Pendentes</h5>
                    <h2>{{ $pendentes }}</h2>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h3>📋 Solicitações de Adoção</h3>

    @foreach($lista as $adocao)
        <div class="card mb-3">
            <div class="card-body">

                <p><strong>Usuário:</strong> {{ $adocao->user->name }}</p>
                <p><strong>Email:</strong> {{ $adocao->user->email }}</p>
                <p><strong>Pet:</strong> {{ $adocao->pet->nome }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge 
                        @if($adocao->status == 'pendente') bg-warning
                        @elseif($adocao->status == 'aprovado') bg-success
                        @else bg-danger
                        @endif
                    ">
                        {{ $adocao->status }}
                    </span>
                </p>

                <a href="/admin/aprovar/{{ $adocao->id }}" class="btn btn-success btn-sm">Aprovar</a>
                <a href="/admin/recusar/{{ $adocao->id }}" class="btn btn-danger btn-sm">Recusar</a>

            </div>
        </div>
    @endforeach

</div>

</body>
</html>