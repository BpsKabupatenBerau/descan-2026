@extends('layouts.app')

@section('title', 'Jumlah KK - Kependudukan | Desa Cantik')

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
        <span class="text-green-700 font-medium">Jumlah KK</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $kategori = $kategori ?? 'kependudukan';
        $subpage  = $subpage  ?? 'jumlah-kk';

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
            <h1 class="text-gray-900 text-2xl font-bold">Jumlah Kepala Keluarga</h1>
            <p class="text-gray-500 text-sm mt-1">Sebaran Kepala Keluarga per dusun di Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 KK</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-4 gap-4">

            {{-- Jumlah KK --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-green-700 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Jumlah KK</p>
                        <p class="text-green-700 text-3xl font-bold leading-none">1.423</p>
                        <p class="text-gray-400 text-[10px] mt-2">KK</p>
                    </div>
                </div>
            </div>

            {{-- Rata-rata Anggota --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-amber-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Rata-rata Anggota</p>
                        <p class="text-amber-500 text-3xl font-bold leading-none">3,4</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa/KK</p>
                    </div>
                </div>
            </div>

            {{-- KK Miskin --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-red-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">KK Miskin</p>
                        <p class="text-red-500 text-3xl font-bold leading-none">68</p>
                        <p class="text-gray-400 text-[10px] mt-2">KK</p>
                    </div>
                </div>
            </div>

            {{-- Kepemilikan Rumah --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-teal-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Kepemilikan Rumah</p>
                        <p class="text-teal-500 text-3xl font-bold leading-none">94,8</p>
                        <p class="text-gray-400 text-[10px] mt-2">%</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-gray-900 text-base font-bold">Grafik — Jumlah Kepala Keluarga</h2>
            </div>
            <p class="text-gray-400 text-[9px] mb-5">Satuan: KK</p>

            <div class="relative" style="height: 300px;">
                <canvas id="chartJumlahKK"></canvas>
            </div>
        </div>

        {{-- Data Tabel --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            {{-- Table Header --}}
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

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-xs" id="tabel-kk">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Dusun</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jumlah KK</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jiwa</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Rata-rata</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">KK Miskin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['dusun' => 'Dusun I',   'kk' => '312', 'jiwa' => '1.060', 'rata' => '3,4', 'miskin' => '14', 'stripe' => true],
                            ['dusun' => 'Dusun II',  'kk' => '284', 'jiwa' => '966',   'rata' => '3,4', 'miskin' => '12', 'stripe' => false],
                            ['dusun' => 'Dusun III', 'kk' => '268', 'jiwa' => '912',   'rata' => '3,4', 'miskin' => '18', 'stripe' => true],
                            ['dusun' => 'Dusun IV',  'kk' => '310', 'jiwa' => '1.054', 'rata' => '3,4', 'miskin' => '16', 'stripe' => false],
                            ['dusun' => 'Dusun V',   'kk' => '249', 'jiwa' => '847',   'rata' => '3,4', 'miskin' => '8',  'stripe' => true],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3 text-gray-900 font-medium">{{ $row['dusun'] }}</td>
                            <td class="px-6 py-3 text-gray-700 font-semibold">{{ $row['kk'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['jiwa'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['rata'] }}</td>
                            <td class="px-6 py-3">
                                <span class="text-red-500 font-medium">{{ $row['miskin'] }}</span>
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
    const ctx = document.getElementById('chartJumlahKK').getContext('2d');

    const dusun  = ['Dusun I', 'Dusun II', 'Dusun III', 'Dusun IV', 'Dusun V'];
    const values = [312, 284, 268, 310, 249];
    const colors = [
        { bg: 'rgba(59,130,246,0.85)',  border: '#3b82f6' },   // blue
        { bg: 'rgba(16,185,129,0.85)',  border: '#10b981' },   // emerald
        { bg: 'rgba(245,158,11,0.85)',  border: '#f59e0b' },   // amber
        { bg: 'rgba(239,68,68,0.85)',   border: '#ef4444' },   // red
        { bg: 'rgba(139,92,246,0.85)',  border: '#8b5cf6' },   // violet
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dusun,
            datasets: [{
                label: 'Jumlah KK',
                data: values,
                backgroundColor: colors.map(c => c.bg),
                borderColor:     colors.map(c => c.border),
                borderWidth: 2,
                borderRadius: 6,
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
                        label: ctx => ' ' + ctx.parsed.y.toLocaleString('id-ID') + ' KK'
                    }
                },
                datalabels: false,
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 11 }, color: '#6b7280' },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    max: 360,
                    ticks: {
                        stepSize: 78,
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
        ['Dusun', 'Jumlah KK', 'Jiwa', 'Rata-rata', 'KK Miskin'],
        ['Dusun I',   312, 1060, '3,4', 14],
        ['Dusun II',  284, 966,  '3,4', 12],
        ['Dusun III', 268, 912,  '3,4', 18],
        ['Dusun IV',  310, 1054, '3,4', 16],
        ['Dusun V',   249, 847,  '3,4',  8],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'jumlah-kk.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-kk');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'jumlah-kk.csv';
    a.click();
}
</script>
@endpush
