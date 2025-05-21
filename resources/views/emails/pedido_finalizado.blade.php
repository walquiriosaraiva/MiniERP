<h2>Olá {{ $pedido->nome_cliente }},</h2>

<p>Seu pedido foi finalizado com sucesso!</p>
<p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>
<p><strong>Status:</strong> {{ ucfirst($pedido->status) }}</p>

<p>Obrigado por comprar com a gente!</p>
