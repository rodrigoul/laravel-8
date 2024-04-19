@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('shopping-list.index') }}" class="btn btn-link">
                <i class="bi bi-arrow-left"></i> Retornar à lista
            </a>
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
            <div class="card">
                <div class="card-header">{{$shoppingList->name}}</div>

                
                <div class="card-body">

                    @if(request()->has('onlyshow') && request()->query('onlyshow') === 'true') 

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        @if ($purchase->items && $purchase->items->count() > 0)
                                            <tr  id="{{ $purchase->id }}">
                                                <td>{{ $purchase->items->name }}</td>
                                                <td> <span class="badge bg-secondary">{{ $purchase->quantity }}</span></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                
                    <form method="POST" id="myFormId" action="{{ route('shopping-list.update', ['id' => $shoppingList->id]) }}">
                        @method('POST')
                        @csrf
                        
                        <input type="hidden" name="id" value="{{ $shoppingList->id }}"/>
                        <div class="mb-3">
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                            <label for="name" class="form-label">{{ __('Nome da Lista') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                    value="{{ old('name', $shoppingList->name) }}" required autofocus minlength="5">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        @php
                            $hasItems = false;
                            foreach ($purchases as $purchase) {
                                if ($purchase->items && $purchase->items->count() > 0) {
                                    $hasItems = true;
                                    break;
                                }
                            }
                        @endphp

                        @if ($hasItems)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantidade</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchases as $purchase)
                                            @if ($purchase->items && $purchase->items->count() > 0)
                                                <tr  id="{{ $purchase->id }}">
                                                    <td>{{ $purchase->items->name }}</td>
                                                    <td> <span class="badge bg-secondary">{{ $purchase->quantity }}</span></td>
                                                    <td>
                                                        <button type="button" alt="remover" title="remover" 
                                                                id="{{ $purchase->id }}" class="btn btn-danger btn-sm removeItemList" onclick="removeItemList(this)">
                                                            <i class="fa-solid fa-x"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        
                        <hr />

                        <div id="item-section">
                            <div class="row mb-3 item-row" style="display: none;">
                                <div class="col-md-4">
                                    <label for="category" class="form-label">{{ __('Categoria') }}</label>
                                    <select class="form-select category-select" onchange="loadItems(this)">
                                        <option value="" selected>{{ __('Selecione uma categoria') }}</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="item" class="form-label">{{ __('Item') }}</label>
                                    <select class="form-select item-select" disabled name="items[]">
                                        <option value="" selected>{{ __('Selecione um item') }}</option>
                                        @foreach ($items as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                                <div class="col-md-2">
                                    <label for="item" class="form-label">{{ __('Qtd') }}</label>
                                    <input type="number" name="quantity[]" class="form-control quantity" min="1" max="10000" disabled/>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" alt="remover" title="remover" class="btn btn-danger remove-item-btn mt-4" onclick="removeItemRow(this)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3"  id="endList">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" onclick="addNewItemRow()"><i class="fa-solid fa-circle-plus"></i> Item</button>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row mb-3">
                                <div class="col-md-12">
                                @if ($hasItems)
                                <label class="form-check-label" for="ended"></label>
                                    <input class="form-check-input" type="checkbox" id="ended" name="ended">
                                    <label for="ended" class="form-label">Marque se deseja fechar a lista</label>
                                @endif
                                <button type="submit" id="submit" class="btn btn-primary float-end">{{ __('Atualizar Lista') }}</button>
                            </div>
                            
                        </div>

                    </form>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function addNewItemRow() {
        
        var itemSection = document.getElementById('item-section');
        var newRow = document.querySelector('.item-row').cloneNode(true);
        newRow.style.display = 'flex';
        var removeBtn = newRow.querySelector('.remove-item-btn');
        removeBtn.style.display = 'inline';

        // Remover atributos required dos selects categoria e item
        newRow.querySelector('.category-select').setAttribute('required', 'required');
        newRow.querySelector('.item-select').setAttribute('required', 'required');

        // Adicionar atributo required ao campo de quantidade e desabilitá-lo
        var quantityInput = newRow.querySelector('.quantity');
        quantityInput.setAttribute('required', 'required');
        quantityInput.removeAttribute('disabled');

        itemSection.appendChild(newRow);
    }

    function removeItemRow(btn) {
        var row = btn.closest('.item-row');
        row.remove();
    }

    function loadItems(selectElement) {
        var itemSelect = selectElement.parentNode.nextElementSibling.querySelector('.item-select');
        var categoryId = selectElement.value;
        var items = <?php echo json_encode($items) ?>; 

        itemSelect.innerHTML = '<option value="" selected>{{ __("Selecione um item") }}</option>';

        items.forEach(function(item) {
            if (item.category_id == categoryId) {
                var option = document.createElement('option');
                option.value = item.id;
                option.text = item.name;
                itemSelect.appendChild(option);
            }
        });

        // Adicionar o atributo required quando os itens são carregados
        itemSelect.setAttribute('required', 'required');
        itemSelect.disabled = false;
    }

    function removeItemList(button) {

        if (confirm('Tem certeza que deseja excluir este item?')) {

            var itemId = button.id;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("purchase.delete", ["id" => '+itemId+']) }}', true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response) {
                            alert('Item excluído com sucesso!');
                            var elem = document.getElementById(itemId);
                            if (elem) {
                                elem.closest('tr').remove();
                            }
                        } else {
                            alert('Erro ao excluir o item.');
                        }
                    } else {
                        alert('Erro ao excluir o item. Por favor, tente novamente.');
                    }
                }
            };

            var data = JSON.stringify({ id: itemId });
            xhr.send(data);
        }
    }

</script>
@endsection
