<div class="filament-forms-widget-container">
    <h2 class="text-xl font-bold mb-4">Pendapatan Harian</h2>
    <div style="height: 300px;">
        {!! $chart->container() !!}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{!! $chart->script() !!}
