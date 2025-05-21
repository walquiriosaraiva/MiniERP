@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $produto->nome }}</h2>
    <p><strong>Preço:</strong> R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

    <form method="POST" action="{{ route('carrinho.adicionar') }}">
        @csrf
        <input type="hidden" name="produto_id" value="{{ $produto->id }}">

        <div class="mb-3">
            <label for="variacao_id" class="form-label">Selecione a Variação</label>
            <select name="variacao_id" id="variacao_id" class="form-select" required>
                <option value="">-- Escolha --</option>
                @foreach($produto->variacoes as $variacao)
                    <option value="{{ $variacao->id }}">{{ $variacao->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required>
        </div>

        <button class="btn btn-primary">Adicionar ao Carrinho</button>
    </form>
</div>
@endsection
