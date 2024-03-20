@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('shopping-list.index') }}" class="btn btn-link">
                <i class="bi bi-arrow-left"></i> Retornar à lista
            </a>
            <div class="card">
                <div class="card-header">{{ __('Atualização') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('shopping-list.update', ['id' => $shoppingList->id]) }}">
                        @method('POST')
                        @csrf
                        
                        <input type="hidden" name="id" value="{{ $shoppingList->id }}"/>
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nome da Lista') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $shoppingList->name) }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">{{ __('Atualizar Lista') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
