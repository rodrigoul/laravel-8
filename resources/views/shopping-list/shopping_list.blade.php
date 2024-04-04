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
            
            <a href="{{ route('shopping-list.cadastrar') }}" class="btn btn-link">Nova Lista +</a>
            
            <div class="card">
                <div class="card-header">{{ __('Listas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->ended ? 'Finalizada' : 'Aberta' }}</td>
                                <td>
                                    @if(!$item->ended)
                                    <a href="{{ route('shopping-list.show', ['id' => $item->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Items / <i class="fas fa-pen"></i> Editar
                                    </a>
                                    @else
                                    <i class="fas fa-lock" title="Lista Encerrada"></i>
                                    <a href="{{ route('shopping-list.show', ['id' => $item->id, 'onlyshow' => 'true']) }}">
                                        <i class="fas fa-eye" title="visualizar"></i>
                                    </a> 
                                    @endif
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
