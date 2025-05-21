<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Variacao;
use App\Models\Estoque;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $carrinho = session('carrinho', []);
        $subtotal = collect($carrinho)->sum(fn($item) => $item['preco'] * $item['quantidade']);

        $frete = 20;
        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15;
        } elseif ($subtotal > 200) {
            $frete = 0;
        }

        return view('carrinho.index', compact('carrinho', 'subtotal', 'frete'));
    }

    public function adicionar(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'variacao_id' => 'required|exists:variacoes,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);
        $variacao = Variacao::findOrFail($request->variacao_id);

        $estoque = Estoque::where('produto_id', $produto->id)
            ->where('variacao_id', $variacao->id)
            ->first();

        if (!$estoque || $estoque->quantidade < $request->quantidade) {
            return redirect()->back()->with('error', 'Estoque insuficiente para essa variação.');
        }

        $carrinho = session()->get('carrinho', []);

        $key = $produto->id . '-' . $variacao->id;
        if (isset($carrinho[$key])) {
            $carrinho[$key]['quantidade'] += $request->quantidade;
        } else {
            $carrinho[$key] = [
                'produto_id' => $produto->id,
                'variacao_id' => $variacao->id,
                'nome_produto' => $produto->nome,
                'nome_variacao' => $variacao->nome,
                'preco' => $produto->preco,
                'quantidade' => $request->quantidade,
            ];
        }

        session(['carrinho' => $carrinho]);

        return redirect()->route('carrinho.index')->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover(Request $request)
    {
        $key = $request->produto_id . '-' . $request->variacao_id;

        $carrinho = session()->get('carrinho', []);
        unset($carrinho[$key]);
        session(['carrinho' => $carrinho]);

        return redirect()->route('carrinho.index')->with('success', 'Produto removido do carrinho.');
    }
}
