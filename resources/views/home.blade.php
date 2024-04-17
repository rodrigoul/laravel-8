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
                        <p class="text-center">{{ __('Bem-vindo(a),') }} {{ Auth::user()->name }}!</p>
                    @endauth

                        {{-- Gráfico de colunas Highcharts --}}
                        <div id="chart-container"></div>
                        <div class="col-md-12"></div>
                        <div id="chart-container-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    document.addEventListener('DOMContentLoaded', function () {

        const categories = <?php echo json_encode($itemsByCategory->pluck('category_name'))?>;
        const totalItems = <?php echo json_encode($itemsByCategory->pluck('total_items'))?>;

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

        const mostBoughtItems = <?php echo json_encode($mostBoughtItems) ?>;
        const itemName = mostBoughtItems.map(item => item.items.name);
        const totalBoughtItems = mostBoughtItems.map(item => item.total_sales);

        if (totalBoughtItems.length > 0) {
            Highcharts.chart('chart-container-2', {
                chart: {
                    type: 'column',
                    backgroundColor: 'white'
                },
                title: {
                    text: 'Mais Comprados'
                },
                xAxis: {
                    categories: itemName
                },
                yAxis: {
                    title: {
                        text: 'Compras'
                    }
                },
                series: [{
                    name: 'Adquiridos',
                    data: totalBoughtItems
                }]
            });
        }
    });
</script>

@endsection
