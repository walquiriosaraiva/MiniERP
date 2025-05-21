<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Estoque;
use App\Models\PedidoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoFinalizadoMail;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::latest()->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    public function finalizar(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'cep' => 'required|regex:/^[0-9]{8}$/',
        ]);

        // Verificar CEP via API do ViaCEP
        $cep = $request->cep;
        $res = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        if ($res->failed() || isset($res['erro'])) {
            return redirect()->back()->with('error', 'CEP inválido!');
        }

        $carrinho = session('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('carrinho.index')->with('error', 'Carrinho está vazio.');
        }

        $subtotal = collect($carrinho)->sum(fn($item) => $item['preco'] * $item['quantidade']);

        $frete = 20;
        if ($subtotal >= 52 && $subtotal <= 166.59) {
            $frete = 15;
        } elseif ($subtotal > 200) {
            $frete = 0;
        }

        $pedido = Pedido::create([
            'nome_cliente' => $request->nome,
            'email_cliente' => $request->email,
            'cep' => $cep,
            'subtotal' => $subtotal,
            'frete' => $frete,
            'total' => $subtotal + $frete,
            'status' => 'pendente',
        ]);

        foreach ($carrinho as $item) {
            $estoque = Estoque::where('produto_id', $item['produto_id'])
                ->where('variacao_id', $item['variacao_id'])
                ->first();

            if (!$estoque || $estoque->quantidade < $item['quantidade']) {
                return redirect()->route('carrinho.index')->with('error', "Estoque insuficiente para {$item['nome_produto']} - {$item['nome_variacao']}");
            }

            $estoque->decrement('quantidade', $item['quantidade']);

            PedidoItem::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['produto_id'],
                'variacao_id' => $item['variacao_id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
                'total' => $item['preco'] * $item['quantidade'],
            ]);

        }

        session()->forget('carrinho');

        Mail::to($pedido->email_cliente)->send(new PedidoFinalizadoMail($pedido));

        return redirect()->route('carrinho.index')->with('success', 'Pedido finalizado com sucesso!');
    }
}
