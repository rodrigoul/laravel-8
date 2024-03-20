@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('category.index') }}" class="btn btn-link" target="blank">
                <i class="bi bi-pencil"></i> Retornar à lista
            </a>
            <div class="card">
                <div class="card-header">{{ __('Cadastro de Categoria') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.create') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nome da Categoria') }}</label>
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