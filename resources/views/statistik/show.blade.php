@extends('layouts.app')

@section('title', $statistic->judul_tabel)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6 flex-wrap">
        <a href="{{ route('home') }}" class="hover:text-green-700">Beranda</a>
        @foreach($breadcrumb as $crumb)
            <span>›</span>
            @if($crumb['url'])
                <a href="{{ $crumb['url'] }}" class="hover:text-green-700">{{ $crumb['label'] }}</a>
            @else
                <span class="text-gray-800 font-medium">{{ $crumb['label'] }}</span>
            @endif
        @endforeach
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Sidebar: siblings --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sticky top-20">
                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-3">
                    {{ $category->judul_kategori }}
                </p>
                <ul class="space-y-1">
                    @foreach($siblings as $sibling)
                    <li>
                        <a href="{{ route('statistik.show', [$category->slug, $sibling->slug]) }}"
                           class="block px-3 py-2 rounded-lg text-sm transition
                               {{ $sibling->id === $statistic->id
                                   ? 'bg-green-50 text-green-700 font-medium'
                                   : 'text-gray-600 hover:bg-gray-50' }}">
                            {{ $sibling->judul_tabel }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Main content --}}
        <div class="lg:col-span-3 space-y-6">

            {{-- Header --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full mb-2">
                            {{ $category->judul_kategori }}
                        </span>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $statistic->judul_tabel }}</h1>
                        @if($statistic->description)
                            <p class="text-gray-500 mt-2">{{ $statistic->description }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 mt-4 text-sm text-gray-500">
                    @if($statistic->data_year)
                        <span>📅 Data Tahun {{ $statistic->data_year }}</span>
                    @endif
                    @if($statistic->satuan?->judul_satuan)
                        <span>📏 Satuan: {{ $statistic->satuan->judul_satuan }}</span>
                    @endif
                    @if($statistic->source)
                        <span>📖 Sumber: {{ $statistic->source }}</span>
                    @endif
                </div>
            </div>

            {{-- Chart / Data --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

                @if($statistic->tipe_chart === 'number')
                    {{-- KPI Number --}}
                    <div class="text-center py-10">
                        <p class="text-6xl font-black text-green-700">{{ $statistic->summary_value }}</p>
                        <p class="text-xl text-gray-500 mt-3">{{ $statistic->summary_label ?? $statistic->judul_tabel }}</p>
                        @if($statistic->satuan?->judul_satuan)
                            <p class="text-gray-400 mt-1">{{ $statistic->satuan->judul_satuan }}</p>
                        @endif
                    </div>

                @elseif($statistic->tipe_chart === 'table')
                    {{-- Table view --}}
                    @php $data = $statistic->toChartJsData(); @endphp
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-4 font-semibold text-gray-600">Label</th>
                                    @foreach($data['datasets'] ?? [] as $ds)
                                        <th class="py-3 px-4 font-semibold text-gray-600">{{ $ds['label'] ?? 'Nilai' }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['labels'] ?? [] as $i => $label)
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                    <td class="py-3 px-4 font-medium text-gray-800">{{ $label }}</td>
                                    @foreach($data['datasets'] ?? [] as $ds)
                                        <td class="py-3 px-4 text-gray-600">
                                            {{ $ds['data'][$i] ?? '-' }}
                                            @if($statistic->satuan?->judul_satuan) {{ $statistic->satuan->judul_satuan }} @endif
                                        </td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    {{-- Chart.js --}}
                    <div class="relative" style="min-height: 350px; max-height: 500px;">
                        <canvas id="mainChart"></canvas>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    const ctx = document.getElementById('mainChart');
    if (!ctx) return;

    const chartData = @json($statistic->toChartJsData());
    const chartType = @json($statistic->tipe_chart);

    // Auto-generate colors if not provided
    const PALETTE = [
        '#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6',
        '#06B6D4','#F97316','#14B8A6','#EC4899','#6366F1'
    ];

    chartData.datasets = (chartData.datasets || []).map((ds, i) => {
        const isLine = chartType === 'line';
        const color = PALETTE[i % PALETTE.length];

        return {
            ...ds,
            backgroundColor: ds.backgroundColor
                ?? (isLine ? color + '33' : chartData.labels?.map((_, j) => PALETTE[j % PALETTE.length])),
            borderColor: ds.borderColor ?? (isLine ? color : 'transparent'),
            borderWidth: ds.borderWidth ?? (isLine ? 2 : 0),
            fill: isLine ? true : undefined,
            tension: isLine ? 0.4 : undefined,
            borderRadius: chartType === 'bar' ? 6 : undefined,
        };
    });

    new Chart(ctx, {
        type: chartType,
        data: chartData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: ['pie','doughnut','polarArea'].includes(chartType) ? 'right' : 'top',
                    labels: { font: { family: 'Inter', size: 13 } }
                },
                tooltip: {
                    callbacks: {
                        label: (ctx) => {
                            const unit = @json($statistic->satuan?->judul_satuan ?? '');
                            return ` ${ctx.dataset.label ?? ''}: ${ctx.parsed.y ?? ctx.parsed} ${unit}`.trim();
                        }
                    }
                }
            },
            scales: ['bar','line'].includes(chartType) ? {
                y: {
                    beginAtZero: true,
                    grid: { color: '#F3F4F6' },
                    ticks: { font: { family: 'Inter' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter' } }
                }
            } : undefined,
        }
    });
})();
</script>
@endpush
