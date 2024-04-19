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

            <a href="{{ route('shopping-list.index') }}" class="btn btn-link">
                <i class="bi bi-pencil"></i> Retornar à lista
            </a>
            <div class="card">
                <div class="card-header">{{ __('Cadastro de Lista') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('shopping-list.create') }}">
                        @csrf

                        <div class="mb-3">
                            <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <label for="name" class="form-label">{{ __('Nome da Lista de Compras') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Cadastrar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection