@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Finalizar Pedido</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('pedido.finalizar') }}">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" name="cep" id="cep" class="form-control" placeholder="Somente números (Ex: 01001000)" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-success">Confirmar Pedido</button>
            <a href="{{ route('carrinho.index') }}" class="btn btn-secondary">Voltar ao Carrinho</a>
        </div>
    </form>
</div>
@endsection
