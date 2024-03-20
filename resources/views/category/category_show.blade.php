@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('category.index') }}" class="btn btn-link" target="blank">
                <i class="bi bi-pencil"></i> Retornar à lista
            </a>
            <div class="card">
                <div class="card-header">{{ __('Editar Categoria') }}</div>

                <div class="card-body">
                    @csrf
                    <form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}"/>
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nome do Item') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $category->name) }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Atualizar') }}</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
