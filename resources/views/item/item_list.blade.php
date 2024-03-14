@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            
            <a href="{{ route('items.cadastrar') }}" class="btn btn-link">Novo Item +</a>
            
            <div class="card">
                <div class="card-header">{{ __('Lista de Itens') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th scope="col">ID</th> -->
                                <th scope="col">Nome</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <!-- <td>{{ $item['id'] }}</td> -->
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>
                                    <a href="{{ route('items.show', ['id' => $item['id']]) }}" class="btn btn-primary btn-sm">
                                        Editar
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection