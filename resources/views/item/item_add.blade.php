@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('items.index') }}" class="btn btn-link" >
                <i class="bi bi-pencil"></i> Retornar à lista
            </a>
            <div class="card">
                <div class="card-header">{{ __('Cadastro de Itens') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('items.create') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nome do Item') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('Categoria') }}</label>
                            <select id="category" class="form-select" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="" selected>{{ __('Selecione uma categoria') }}</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Cadastrar Item') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection