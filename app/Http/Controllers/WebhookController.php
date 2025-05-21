<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class WebhookController extends Controller
{
    public function atualizarStatus(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:pedidos,id',
            'status' => 'required|string',
        ]);

        $pedido = Pedido::findOrFail($request->id);

        if ($request->status === 'cancelado') {
            foreach ($pedido->itens as $item) {
                $estoque = \App\Models\Estoque::where('produto_id', $item->produto_id)
                    ->where('variacao_id', $item->variacao_id)
                    ->first();

                if ($estoque) {
                    $estoque->increment('quantidade', $item->quantidade);
                }
            }

            $pedido->delete();

            return response()->json(['status' => 'Pedido cancelado, estoque restaurado e pedido removido']);
        }

        $pedido->status = $request->status;
        $pedido->save();

        return response()->json(['status' => 'Status atualizado para ' . $request->status]);
    }
}
