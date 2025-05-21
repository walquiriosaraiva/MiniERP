@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pedidos Finalizados</h2>

    @if($pedidos->isEmpty())
        <p>Nenhum pedido finalizado ainda.</p>
    @else
        <div class="accordion" id="pedidosAccordion">
            @foreach($pedidos as $pedido)
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading{{ $pedido->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $pedido->id }}" aria-expanded="false" aria-controls="collapse{{ $pedido->id }}">
                            Pedido #{{ $pedido->id }} - {{ $pedido->nome_cliente }} - R$ {{ number_format($pedido->total, 2, ',', '.') }} ({{ $pedido->status }})
                        </button>
                    </h2>
                    <div id="collapse{{ $pedido->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $pedido->id }}" data-bs-parent="#pedidosAccordion">
                        <div class="accordion-body">
                            <p><strong>E-mail:</strong> {{ $pedido->email_cliente }}</p>
                            <p><strong>CEP:</strong> {{ $pedido->cep }}</p>
                            <p><strong>Data:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Subtotal:</strong> R$ {{ number_format($pedido->subtotal, 2, ',', '.') }}</p>
                            <p><strong>Frete:</strong> R$ {{ number_format($pedido->frete, 2, ',', '.') }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

                            @if($pedido->itens->isNotEmpty())
                                <table class="table table-sm table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Variação</th>
                                            <th>Qtd</th>
                                            <th>Preço Unit.</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pedido->itens as $item)
                                            <tr>
                                                <td>{{ $item->produto->nome }}</td>
                                                <td>{{ $item->variacao?->nome ?? '-' }}</td>
                                                <td>{{ $item->quantidade }}</td>
                                                <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                                <td>R$ {{ number_format($item->total, 2, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
