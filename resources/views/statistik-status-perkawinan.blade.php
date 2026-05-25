@extends('layouts.app')

@section('title', 'Status Perkawinan - Kependudukan | Desa Cantik')

@section('content')

{{-- BREADCRUMB --}}
<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="{{ url('/') }}" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="{{ url('/statistik') }}" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <a href="{{ url('/statistik') }}" class="hover:text-green-700 transition-colors">Kependudukan</a>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Status Perkawinan</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $subpage = $subpage ?? 'status-perkawinan';
        $sidebarItems = [
            ['label' => 'Total Penduduk',      'icon' => '👥', 'href' => '/statistik/total-penduduk',      'slug' => 'total-penduduk'],
            ['label' => 'Jumlah KK',            'icon' => '🏠', 'href' => '/statistik/jumlah-kk',            'slug' => 'jumlah-kk'],
            ['label' => 'Tingkat Pendidikan',   'icon' => '📚', 'href' => '/statistik',                      'slug' => 'tingkat-pendidikan'],
            ['label' => 'Jenis Kelamin',        'icon' => '⚤',  'href' => '/statistik/jenis-kelamin',        'slug' => 'jenis-kelamin'],
            ['label' => 'Pertumbuhan Penduduk', 'icon' => '📈', 'href' => '/statistik/pertumbuhan-penduduk', 'slug' => 'pertumbuhan-penduduk'],
            ['label' => 'Usia Produktif',       'icon' => '💪', 'href' => '/statistik/usia-produktif',       'slug' => 'usia-produktif'],
            ['label' => 'Status Perkawinan',    'icon' => '💍', 'href' => '/statistik/status-perkawinan',    'slug' => 'status-perkawinan'],
        ];
        @endphp
        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Kependudukan</p>
        </div>
        <nav>
            @foreach($sidebarItems as $item)
                @if($item['slug'] === $subpage)
                <div class="flex items-stretch mx-3 mb-0.5">
                    <div class="w-1 bg-green-700 rounded-full flex-shrink-0"></div>
                    <span class="flex-1 bg-green-50 text-green-700 text-xs font-bold px-3 py-2.5 rounded-r flex items-center gap-2">
                        <span>{{ $item['icon'] }}</span> {{ $item['label'] }}
                    </span>
                </div>
                @else
                <a href="{{ url($item['href']) }}" class="flex items-center gap-2 mx-4 py-2 px-3 text-xs text-gray-600 hover:text-green-700 hover:bg-gray-50 rounded transition-colors mb-0.5">
                    <span>{{ $item['icon'] }}</span> {{ $item['label'] }}
                </a>
                @endif
            @endforeach
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-6 space-y-5">

        {{-- Header Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <div class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded mb-3">
                Kependudukan
            </div>
            <h1 class="text-gray-900 text-2xl font-bold">Status Perkawinan</h1>
            <p class="text-gray-500 text-sm mt-1">Komposisi penduduk berdasarkan status perkawinan</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-gray-900 text-base font-bold mb-6">Grafik — Status Perkawinan</h2>

            <div class="flex items-center justify-center gap-16">

                {{-- Donut Chart --}}
                <div class="relative flex-shrink-0" style="width: 280px; height: 280px;">
                    <canvas id="chartStatusKawin"></canvas>
                    {{-- Center Label --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-gray-900 text-xl font-bold">4.872</span>
                        <span class="text-gray-500 text-[10px] mt-0.5">Total</span>
                    </div>
                </div>

                {{-- Legend --}}
                <div class="space-y-5">
                    @php
                    $legend = [
                        ['color' => 'bg-sky-500',   'text_color' => 'text-sky-500',   'label' => 'Belum Kawin', 'val' => '1.820', 'pct' => '37,4%'],
                        ['color' => 'bg-green-700', 'text_color' => 'text-green-700', 'label' => 'Kawin',       'val' => '2.640', 'pct' => '54,2%'],
                        ['color' => 'bg-amber-500', 'text_color' => 'text-amber-500', 'label' => 'Cerai Hidup', 'val' => '180',   'pct' => '3,7%'],
                        ['color' => 'bg-red-500',   'text_color' => 'text-red-500',   'label' => 'Cerai Mati',  'val' => '232',   'pct' => '4,7%'],
                    ];
                    @endphp
                    @foreach($legend as $item)
                    <div class="flex items-center gap-4">
                        <div class="w-4 h-4 rounded {{ $item['color'] }} flex-shrink-0"></div>
                        <div>
                            <p class="text-gray-700 text-sm font-semibold">{{ $item['label'] }}</p>
                            <p class="{{ $item['text_color'] }} text-xl font-bold leading-none mt-0.5">{{ $item['val'] }}</p>
                            <p class="text-gray-400 text-[10px] mt-0.5">{{ $item['pct'] }} dari total penduduk</p>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- Data Tabel --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-gray-900 text-sm font-bold">Data Tabel</h2>
                    <p class="text-gray-500 text-xs mt-0.5">5 baris data</p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="window.print()"
                        class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 text-xs font-bold hover:bg-gray-50 transition-colors">
                        <span>🖨</span> Print
                    </button>
                    <div class="relative" id="unduh-wrapper">
                        <button onclick="toggleUnduhDropdown()"
                            class="flex items-center gap-2 px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-lg hover:bg-green-800 transition-colors">
                            ⬇ Unduh Data
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="unduh-menu"
                            class="hidden absolute right-0 top-full mt-1.5 w-44 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50">
                            <button onclick="unduhCSV()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-red-500 hover:bg-red-50 transition-colors">
                                <span>📄</span> Unduh PDF
                            </button>
                            <div class="border-t border-gray-100 mx-3"></div>
                            <button onclick="unduhCSV()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                <span>📊</span> Unduh CSV
                            </button>
                            <div class="border-t border-gray-100 mx-3"></div>
                            <button onclick="unduhExcel()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                <span>📗</span> Unduh Excel
                            </button>
                            <div class="border-t border-gray-100 mx-3"></div>
                            <button onclick="window.print()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-gray-50 transition-colors">
                                <span>🖨</span> Cetak / Print
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs" id="tabel-kawin">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Status</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laki-laki</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Perempuan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Total</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['status'=>'Belum Kawin', 'dot'=>'bg-sky-500',   'l'=>'980',   'p'=>'840',   'total'=>'1.820', 'pct'=>'37,4%', 'stripe'=>true,  'bold'=>false],
                            ['status'=>'Kawin',       'dot'=>'bg-green-700', 'l'=>'1.380', 'p'=>'1.260', 'total'=>'2.640', 'pct'=>'54,2%', 'stripe'=>false, 'bold'=>false],
                            ['status'=>'Cerai Hidup', 'dot'=>'bg-amber-500', 'l'=>'52',    'p'=>'128',   'total'=>'180',   'pct'=>'3,7%',  'stripe'=>true,  'bold'=>false],
                            ['status'=>'Cerai Mati',  'dot'=>'bg-red-500',   'l'=>'68',    'p'=>'164',   'total'=>'232',   'pct'=>'4,7%',  'stripe'=>false, 'bold'=>false],
                            ['status'=>'Total',       'dot'=>'bg-gray-400',  'l'=>'2.480', 'p'=>'2.392', 'total'=>'4.872', 'pct'=>'100%',  'stripe'=>true,  'bold'=>true],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $row['dot'] }} flex-shrink-0"></span>
                                    <span class="{{ $row['bold'] ? 'text-gray-900 font-bold' : 'text-gray-900 font-medium' }}">{{ $row['status'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700 {{ $row['bold'] ? 'font-bold' : '' }}">{{ $row['l'] }}</td>
                            <td class="px-6 py-3 text-gray-700 {{ $row['bold'] ? 'font-bold' : '' }}">{{ $row['p'] }}</td>
                            <td class="px-6 py-3 text-gray-700 font-semibold">{{ $row['total'] }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $row['pct'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function () {
    const ctx = document.getElementById('chartStatusKawin').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
            datasets: [{
                data: [1820, 2640, 180, 232],
                backgroundColor: [
                    'rgba(14,165,233,0.88)',  // sky
                    'rgba(21,128,61,0.88)',   // green-700
                    'rgba(245,158,11,0.88)',  // amber
                    'rgba(239,68,68,0.88)',   // red
                ],
                borderColor: ['#0ea5e9','#15803d','#f59e0b','#ef4444'],
                borderWidth: 2,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => {
                            const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            const pct   = ((ctx.parsed / total) * 100).toFixed(1);
                            return ' ' + ctx.parsed.toLocaleString('id-ID') + ' jiwa (' + pct + '%)';
                        }
                    }
                }
            },
            animation: { duration: 900, easing: 'easeInOutQuart' }
        }
    });
})();

// Unduh dropdown
function toggleUnduhDropdown() {
    document.getElementById('unduh-menu').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('unduh-wrapper');
    const menu    = document.getElementById('unduh-menu');
    if (wrapper && !wrapper.contains(e.target)) menu.classList.add('hidden');
});

function unduhCSV() {
    const rows = [
        ['Status','Laki-laki','Perempuan','Total','%'],
        ['Belum Kawin', 980,   840,   1820, '37.4%'],
        ['Kawin',       1380,  1260,  2640, '54.2%'],
        ['Cerai Hidup', 52,    128,   180,  '3.7%'],
        ['Cerai Mati',  68,    164,   232,  '4.7%'],
        ['Total',       2480,  2392,  4872, '100%'],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'status-perkawinan.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-kawin');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'status-perkawinan.csv';
    a.click();
}
</script>
@endpush
