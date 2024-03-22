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
                    <!-- Formulário de atualização da lista -->
                    <form method="POST" action="{{ route('shopping-list.update', ['id' => $shoppingList->id]) }}">
                        @method('POST')
                        @csrf
                        
                        <!-- Campos do formulário -->
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

                        <hr />

                        <div id="item-section">
                            <div class="row mb-3 item-row" style="display: none;">
                                <div class="col-md-6">
                                    <label for="category" class="form-label">{{ __('Categoria') }}</label>
                                    <select class="form-select category-select" onchange="loadItems(this)">
                                        <option value="" selected>{{ __('Selecione uma categoria') }}</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="item" class="form-label">{{ __('Item') }}</label>
                                    <select class="form-select item-select" disabled name="items[]">
                                        <option value="" selected>{{ __('Selecione um item') }}</option>
                                        @foreach ($items as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3"  id="endList">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input class="form-check-input" type="checkbox" id="ended" name="ended">
                                    <label class="form-check-label" for="ended"></label>
                                    <label for="ended" class="form-label">Marque se deseja encerrar a lista após adicionar os itens</label>

                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" onclick="addNewItemRow()"><i class="fa-solid fa-circle-plus"></i> Item</button>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary float-end">{{ __('Atualizar Lista') }}</button>
                            </div>
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function addNewItemRow() {
        var itemSection = document.getElementById('item-section');
        var newRow = document.querySelector('.item-row').cloneNode(true);
        newRow.style.display = 'flex';
        itemSection.appendChild(newRow);
    }

    function loadItems(selectElement) {

        var itemSelect = selectElement.parentNode.nextElementSibling.querySelector('.item-select');
        var categoryId = selectElement.value;
        var items = {!! json_encode($items) !!}; 

        itemSelect.innerHTML = '<option value="" selected>{{ __('Selecione um item') }}</option>';

        items.forEach(function(item) {
            if (item.category_id == categoryId) {
                var option = document.createElement('option');
                option.value = item.id;
                option.text = item.name;
                itemSelect.appendChild(option);
            }
        });

        itemSelect.disabled = false;
    }
</script>
@endsection
