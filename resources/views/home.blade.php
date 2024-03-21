@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Saudação personalizada com o nome do usuário --}}
                    @auth
                        <p>{{ __('Bem-vindo(a),') }} {{ Auth::user()->name }}!</p>
                    @endauth

                        {{-- Gráfico de colunas Highcharts --}}
                        <div id="chart-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    document.addEventListener('DOMContentLoaded', function () {
        // Dados das categorias e quantidades de itens

        const categories = <?php echo json_encode($categories->pluck('category_name'))?>;
        const totalItems = <?php echo json_encode($categories->pluck('total_items'))?>;

        if(totalItems){
            
            Highcharts.chart('chart-container', {
                chart: {
                    type: 'column',
                    backgroundColor: 'white'
                },
                title: {
                    text: 'Total de Itens por Categoria'
                },
                xAxis: {
                    categories: categories
                },
                yAxis: {
                    title: {
                        text: 'Quantidade de Itens'
                    }
                },
                series: [{
                    name: 'Itens',
                    data: totalItems
                }]
            });
        }
    });
</script>

@endsection
