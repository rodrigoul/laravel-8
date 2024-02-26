@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Listas') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="accordion" id="accordionFlushExample">
                        @foreach($shoppingLists as $shoppingList)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $shoppingList['id'] }}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $shoppingList['id'] }}" aria-expanded="false" aria-controls="collapse{{ $shoppingList['id'] }}">
                                        {{ $shoppingList['name'] }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $shoppingList['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $shoppingList['id'] }}" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Quantidade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($shoppingList['items'] as $item)
                                                    <tr>
                                                        <td>{{ $item['id'] }}</td>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['quantity'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var accordions = document.querySelectorAll('.accordion-button');
    accordions.forEach(function(accordion) {
        accordion.addEventListener('click', function() {
            accordion.classList.toggle('collapsed');
        });
    });
</script>
@endsection
