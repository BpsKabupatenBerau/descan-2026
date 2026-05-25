@extends('layouts.app')

@section('title', 'Usia Produktif - Kependudukan | Desa Cantik')

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
        <span class="text-green-700 font-medium">Usia Produktif</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $subpage = $subpage ?? 'usia-produktif';
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
            <h1 class="text-gray-900 text-2xl font-bold">Usia Produktif</h1>
            <p class="text-gray-500 text-sm mt-1">Piramida usia dan komposisi kelompok umur penduduk</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="flex gap-4">
            <div class="flex-1 bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-yellow-400 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Belum / Pra Produktif</p>
                        <p class="text-yellow-500 text-3xl font-bold leading-none">1.337</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa (0–19 tahun)</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-green-600 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Usia Produktif</p>
                        <p class="text-green-600 text-3xl font-bold leading-none">2.160</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa (20–54 tahun)</p>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-slate-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Lansia & Pra Lansia</p>
                        <p class="text-slate-500 text-3xl font-bold leading-none">718</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa (55+ tahun)</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-gray-900 text-base font-bold mb-1">Grafik — Usia Produktif</h2>
            <p class="text-gray-400 text-[9px] mb-5">Satuan: Jiwa</p>

            <div class="relative" style="height: 320px;">
                <canvas id="chartUsiaProduktif"></canvas>
            </div>
        </div>

        {{-- Data Tabel --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-gray-900 text-sm font-bold">Data Tabel</h2>
                    <p class="text-gray-500 text-xs mt-0.5">8 baris data</p>
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
                <table class="w-full text-xs" id="tabel-usia">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Kelompok Usia</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laki-laki</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Perempuan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Total</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['usia'=>'0 – 14 tahun', 'l'=>'490','p'=>'467','total'=>'957', 'kat'=>'Belum Produktif','katColor'=>'text-yellow-600 bg-yellow-50','stripe'=>true],
                            ['usia'=>'15 – 19 tahun','l'=>'193','p'=>'187','total'=>'380', 'kat'=>'Pra Produktif',  'katColor'=>'text-orange-600 bg-orange-50','stripe'=>false],
                            ['usia'=>'20 – 24 tahun','l'=>'148','p'=>'142','total'=>'290', 'kat'=>'Produktif',       'katColor'=>'text-green-700 bg-green-50', 'stripe'=>true],
                            ['usia'=>'25 – 34 tahun','l'=>'342','p'=>'338','total'=>'680', 'kat'=>'Produktif',       'katColor'=>'text-green-700 bg-green-50', 'stripe'=>false],
                            ['usia'=>'35 – 44 tahun','l'=>'358','p'=>'352','total'=>'710', 'kat'=>'Produktif',       'katColor'=>'text-green-700 bg-green-50', 'stripe'=>true],
                            ['usia'=>'45 – 54 tahun','l'=>'243','p'=>'237','total'=>'480', 'kat'=>'Produktif',       'katColor'=>'text-green-700 bg-green-50', 'stripe'=>false],
                            ['usia'=>'55 – 64 tahun','l'=>'148','p'=>'147','total'=>'295', 'kat'=>'Pra Lansia',      'katColor'=>'text-blue-600 bg-blue-50',   'stripe'=>true],
                            ['usia'=>'65+ tahun',    'l'=>'210','p'=>'213','total'=>'423', 'kat'=>'Lansia',          'katColor'=>'text-slate-600 bg-slate-100','stripe'=>false],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3 text-gray-900 font-medium">{{ $row['usia'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['l'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['p'] }}</td>
                            <td class="px-6 py-3 text-gray-700 font-semibold">{{ $row['total'] }}</td>
                            <td class="px-6 py-3">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $row['katColor'] }}">
                                    {{ $row['kat'] }}
                                </span>
                            </td>
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
    const ctx    = document.getElementById('chartUsiaProduktif').getContext('2d');
    const labels = ['0–4', '5–9', '10–14', '15–19', '20–24', '25–34', '35–44', '45–54', '55–64', '65+'];
    const values = [312,   340,   305,    380,    290,    680,    710,    480,    295,    420];

    // Color scheme: belum produktif = yellow, produktif = green tones, lansia = slate
    const colors = [
        'rgba(234,179,8,0.85)',   // 0–4   yellow
        'rgba(234,179,8,0.85)',   // 5–9   yellow
        'rgba(234,179,8,0.85)',   // 10–14 yellow
        'rgba(249,115,22,0.85)',  // 15–19 orange (pra produktif)
        'rgba(22,163,74,0.85)',   // 20–24 green
        'rgba(6,182,212,0.85)',   // 25–34 cyan
        'rgba(249,115,22,0.85)',  // 35–44 orange
        'rgba(20,184,166,0.85)',  // 45–54 teal
        'rgba(100,116,139,0.85)', // 55–64 slate
        'rgba(71,85,105,0.85)',   // 65+   slate-dark
    ];
    const borders = [
        '#eab308','#eab308','#eab308',
        '#f97316',
        '#16a34a','#06b6d4','#f97316','#14b8a6',
        '#64748b','#475569',
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah (Jiwa)',
                data: values,
                backgroundColor: colors,
                borderColor:     borders,
                borderWidth: 2,
                borderRadius: 5,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.parsed.y.toLocaleString('id-ID') + ' jiwa'
                    }
                },
                datalabels: false,
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 10 }, color: '#6b7280' },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    max: 800,
                    ticks: {
                        stepSize: 177,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => val.toLocaleString('id-ID'),
                    },
                    grid: { color: '#f3f4f6', lineWidth: 1 },
                    border: { display: false, dash: [4, 4] }
                }
            },
            animation: { duration: 800, easing: 'easeInOutQuart' }
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
        ['Kelompok Usia','Laki-laki','Perempuan','Total','Kategori'],
        ['0-14 tahun',  490, 467, 957,  'Belum Produktif'],
        ['15-19 tahun', 193, 187, 380,  'Pra Produktif'],
        ['20-24 tahun', 148, 142, 290,  'Produktif'],
        ['25-34 tahun', 342, 338, 680,  'Produktif'],
        ['35-44 tahun', 358, 352, 710,  'Produktif'],
        ['45-54 tahun', 243, 237, 480,  'Produktif'],
        ['55-64 tahun', 148, 147, 295,  'Pra Lansia'],
        ['65+ tahun',   210, 213, 423,  'Lansia'],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'usia-produktif.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-usia');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'usia-produktif.csv';
    a.click();
}
</script>
@endpush
