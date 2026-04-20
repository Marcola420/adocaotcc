
<h2>Pets disponíveis para adoção 🐶</h2>

@foreach($pets as $pet)
    <div class="card p-3 mb-2">
        <h4>{{ $pet->name }}</h4>
        <p>Raça: {{ $pet->breed }}</p>
        <p>Idade: {{ $pet->age }}</p>

        <a href="/adoptions/create?pet={{ $pet->name }}" class="btn btn-primary">
            Adotar
        </a>
    </div>
@endforeach