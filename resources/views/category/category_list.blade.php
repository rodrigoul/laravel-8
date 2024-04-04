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
            
            <a href="{{ route('category.cadastrar') }}" class="btn btn-link" target="blank">Nova Categoria +</a>
            
            <div class="card">
                <div class="card-header">{{ __('Categorias') }}</div>

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
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('category.show', ['id' => $category->id]) }}" class="btn btn-primary btn-sm" target="blank">
                                        Editar
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <button type="button" alt="remover" title="remover" 
                                            id="{{ $category->id }}" class="btn btn-danger btn-sm" onclick="removeCategory(this)">
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

        function removeCategory(button) {

            if (confirm('Tem certeza que deseja excluir esta categoria?')) {

                var itemId = button.id;
                var xhr = new XMLHttpRequest();
                var baseUrl = window.location.origin; // Obtém a URL base do navegador
                var route = baseUrl + '/category/delete/' + itemId; // Monta a rota manualmente

                //console.log(route); return false;
                xhr.open('POST', route, true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            if (response) {
                                alert('Categoria excluída com sucesso!');
                                var elem = document.getElementById(itemId);
                                if (elem) {
                                    elem.closest('tr').remove();
                                }
                            } else {
                                alert('Erro ao excluir categoria.');
                            }
                        } else {
                            alert('Erro ao excluir categoria. Por favor, tente novamente.');
                        }
                    }
                };

                var data = JSON.stringify({ id: itemId });
                xhr.send(data);
            }
        }
</script>

@endsection

