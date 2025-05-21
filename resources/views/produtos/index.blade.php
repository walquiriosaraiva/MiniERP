@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Produtos</h2>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo Produto</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-secondary">Editar</a>
                    <form method="POST" action="{{ route('carrinho.adicionar') }}">
                    @csrf
                    <input type="hidden" name="produto_id" value="{{ $produto->id }}">

                    <div class="mb-1">
                        <select name="variacao_id" class="form-select form-select-sm" required>
                            <option value="">-- Variação --</option>
                            @foreach($produto->variacoes as $variacao)
                                <option value="{{ $variacao->id }}">{{ $variacao->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-1">
                        <input type="number" name="quantidade" class="form-control form-control-sm" placeholder="Qtd" min="1" required>
                    </div>

                    <button class="btn btn-sm btn-success mt-1" type="submit">Comprar</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
