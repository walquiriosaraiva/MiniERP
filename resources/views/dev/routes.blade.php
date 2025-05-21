@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rotas Registradas</h2>

    <table class="table table-bordered table-sm table-striped">
        <thead>
            <tr>
                <th>Método</th>
                <th>URI</th>
                <th>Nome</th>
                <th>Controller</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>
                        @if(isset($route['methods']))
                            {{ implode('|', $route['methods']) }}
                        @elseif(isset($route['method']))
                            {{ $route['method'] }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $route['uri'] }}</td>
                    <td>{{ $route['name'] ?? '-' }}</td>
                    <td>{{ $route['action']['controller'] ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
