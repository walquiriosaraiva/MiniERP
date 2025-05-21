@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Cadastrar Produto</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('produtos.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>

        <hr>
        <h5>Variações</h5>
        <div id="variacoes-wrapper"></div>

        <button type="button" class="btn btn-secondary mb-3" onclick="adicionarVariacao()">+ Adicionar Variação</button>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Salvar Produto</button>
        </div>
    </form>
</div>

<script>
    let index = 0;

    function adicionarVariacao() {
        const wrapper = document.getElementById('variacoes-wrapper');

        const div = document.createElement('div');
        div.classList.add('row', 'mb-2');
        div.innerHTML = `
            <div class="col">
                <input type="text" name="variacoes[${index}][nome]" class="form-control" placeholder="Nome da Variação" required>
            </div>
            <div class="col">
                <input type="number" name="variacoes[${index}][quantidade]" class="form-control" placeholder="Estoque" required>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Remover</button>
            </div>
        `;
        wrapper.appendChild(div);
        index++;
    }
</script>
@endsection
