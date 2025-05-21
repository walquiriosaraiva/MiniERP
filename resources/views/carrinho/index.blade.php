@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Meu Carrinho</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($carrinho) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Variação</th>
                    <th>Preço Unitário</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrinho as $item)
                    <tr>
                        <td>{{ $item['nome_produto'] }}</td>
                        <td>{{ $item['nome_variacao'] }}</td>
                        <td>R$ {{ number_format($item['preco'], 2, ',', '.') }}</td>
                        <td>{{ $item['quantidade'] }}</td>
                        <td>R$ {{ number_format($item['preco'] * $item['quantidade'], 2, ',', '.') }}</td>
                        <td>
                            <form method="POST" action="{{ route('carrinho.remover') }}">
                                @csrf
                                <input type="hidden" name="produto_id" value="{{ $item['produto_id'] }}">
                                <input type="hidden" name="variacao_id" value="{{ $item['variacao_id'] }}">
                                <button class="btn btn-danger btn-sm">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <p><strong>Subtotal:</strong> R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
            <p><strong>Frete:</strong> R$ {{ number_format($frete, 2, ',', '.') }}</p>
            <p><strong>Total:</strong> R$ {{ number_format($subtotal + $frete, 2, ',', '.') }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ url('/carrinho/finalizar') }}" class="btn btn-success">Finalizar Pedido</a>
        </div>
    @else
        <p>Seu carrinho está vazio.</p>
    @endif
</div>
@endsection
