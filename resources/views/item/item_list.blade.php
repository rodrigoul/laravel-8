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
                                    <button type="button" alt="remover" title="remover" 
                                            id="{{ $item->id }}" class="btn btn-danger btn-sm" onclick="removeCreatedItem(this)">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
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

<script type="text/javascript">

        function removeCreatedItem(button) {

            if (confirm('Tem certeza que deseja excluir este item?')) {

                var itemId = button.id;
                var xhr = new XMLHttpRequest();
                var baseUrl = window.location.origin;
                var route = baseUrl + '/items/delete/' + itemId; 

                //console.log(route); return false;
                xhr.open('POST', route, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response) {
                                alert('Item removido com sucesso!');
                                var elem = document.getElementById(itemId);
                                if (elem) {
                                    elem.closest('tr').remove();
                                }
                            } else {
                                alert('Erro ao excluir item.');
                            }
                        } else {
                            alert('Erro ao excluir item. Por favor, tente novamente.');
                        }
                    }
                };

                var data = JSON.stringify({ id: itemId });
                xhr.send(data);
            }
        }
</script>
@endsection