<h2>Cadastro para Adoção 🐾</h2>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <input type="text" name="name" placeholder="Nome completo" class="form-control mb-2">

    <input type="email" name="email" placeholder="Email" class="form-control mb-2">

    <input type="text" name="phone" placeholder="Telefone" class="form-control mb-2">

    <input type="password" name="password" placeholder="Senha" class="form-control mb-2">

    <input type="password" name="password_confirmation" placeholder="Confirmar senha" class="form-control mb-2">

    <button class="btn btn-success">Criar conta</button>
</form>