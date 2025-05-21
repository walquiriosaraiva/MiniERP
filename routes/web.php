<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\WebhookController;

Route::get('/', function () {
    return view('welcome');
});

#produtos
Route::get('/produtos/criar', function () {
    return view('produtos.create');
})->name('produtos.create');

Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/produtos/lista', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');

#carrinho
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::post('/carrinho/remover', [CarrinhoController::class, 'remover'])->name('carrinho.remover');

#finalizar pedido
Route::post('/pedido/finalizar', [PedidoController::class, 'finalizar'])->name('pedido.finalizar');

Route::get('/carrinho/finalizar', function () {
    return view('carrinho.finalizar');
})->name('carrinho.finalizar');

#pedidos
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

#lista de rotas enviadas para a view
Route::get('/dev/routes', function () {
    Artisan::call('route:list', ['--json' => true]);
    $routes = json_decode(Artisan::output(), true);

    return view('dev.routes', compact('routes'));
});
