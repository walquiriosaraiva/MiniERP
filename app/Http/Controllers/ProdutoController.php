<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Variacao;
use App\Models\Estoque;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::with('variacoes')->get();
        return view('produtos.index', compact('produtos'));
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
        $request->validate([
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'variacoes' => 'array',
            'variacoes.*.nome' => 'required|string|max:255',
            'variacoes.*.quantidade' => 'required|integer|min:0',
        ]);

        $produto = Produto::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
        ]);

        if($request->variacoes){
            foreach ($request->variacoes as $var) {
                $variacao = Variacao::create([
                    'produto_id' => $produto->id,
                    'nome' => $var['nome'],
                ]);

                Estoque::create([
                    'produto_id' => $produto->id,
                    'variacao_id' => $variacao->id,
                    'quantidade' => $var['quantidade'],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produto = Produto::with('variacoes')->findOrFail($id);
        return view('produtos.show', compact('produto'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
