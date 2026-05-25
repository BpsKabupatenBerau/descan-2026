@extends('layouts.app')

@section('title', 'Mata Pencaharian - Ekonomi | Desa Cantik')

@section('content')

{{-- BREADCRUMB --}}
<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="{{ url('/') }}" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="{{ url('/statistik') }}" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-500">Ekonomi</span>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Mata Pencaharian</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $kategori = 'ekonomi';
        $subpage  = 'mata-pencaharian';

        $ekonomiItems = [
            ['label' => 'UMKM',              'icon' => '🏪', 'href' => '/statistik/ekonomi/umkm',               'slug' => 'umkm'],
            ['label' => 'Mata Pencaharian',   'icon' => '⛏️',  'href' => '/statistik/ekonomi/mata-pencaharian',   'slug' => 'mata-pencaharian'],
            ['label' => 'Pendapatan Desa',    'icon' => '💵', 'href' => '/statistik/ekonomi/pendapatan-desa',    'slug' => 'pendapatan-desa'],
            ['label' => 'Produksi Pertanian', 'icon' => '🌾', 'href' => '/statistik/ekonomi/produksi-pertanian', 'slug' => 'produksi-pertanian'],
            ['label' => 'Kemiskinan',         'icon' => '📉', 'href' => '/statistik/ekonomi/tingkat-kemiskinan', 'slug' => 'tingkat-kemiskinan'],
        ];
        @endphp

        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Ekonomi</p>
        </div>
        <nav>
            @foreach($ekonomiItems as $item)
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
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded mb-3">
                Ekonomi
            </div>
            <h1 class="text-gray-900 text-2xl font-bold">Mata Pencaharian</h1>
            <p class="text-gray-500 text-sm mt-1">Distribusi mata pencaharian penduduk Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 BPS 2024</span>
            </div>
        </div>

        {{-- Chart Card (Doughnut Chart) --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h2 class="text-gray-900 text-base font-bold mb-6">Grafik — Mata Pencaharian</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                {{-- Left: Doughnut Chart --}}
                <div class="relative flex justify-center items-center">
                    <div style="width: 240px; height: 240px;">
                        <canvas id="chartMataPencaharian"></canvas>
                    </div>
                    {{-- Center Label --}}
                    <div class="absolute flex flex-col justify-center items-center text-center">
                        <span class="text-gray-900 text-3xl font-bold leading-none">4.142</span>
                        <span class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mt-1">Total Jiwa</span>
                    </div>
                </div>

                {{-- Right: Legend Grid --}}
                <div class="grid grid-cols-2 gap-4">
                    <!-- Petani -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-green-700 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Petani</p>
                                <p class="text-[10px] text-gray-400">1.240 Jiwa</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-green-700">29.9%</span>
                    </div>

                    <!-- Buruh -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-amber-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Buruh</p>
                                <p class="text-[10px] text-gray-400">860 Jiwa</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-amber-600">20.8%</span>
                    </div>

                    <!-- Wiraswasta -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-blue-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Wiraswasta</p>
                                <p class="text-[10px] text-gray-400">640 Jiwa</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-blue-500">15.5%</span>
                    </div>

                    <!-- PNS/TNI -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-sky-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">PNS/TNI</p>
                                <p class="text-[10px] text-gray-400">280 Jiwa</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-sky-500">6.8%</span>
                    </div>

                    <!-- Pelajar -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-violet-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Pelajar</p>
                                <p class="text-[10px] text-gray-400">720 Jiwa</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-violet-500">17.4%</span>
                    </div>

                    <!-- Lainnya -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-gray-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Lainnya</p>
                                <p class="text-[10px] text-gray-400">402 Jiwa</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-gray-500">9.7%</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Tabel --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

            {{-- Table Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-gray-900 text-sm font-bold">Data Tabel</h2>
                    <p class="text-gray-500 text-xs mt-0.5">8 baris data</p>
                </div>
                <div class="flex items-center gap-2">
                    {{-- Print Button --}}
                    <button onclick="window.print()"
                        class="flex items-center gap-2 px-4 py-2 border border-gray-200 rounded-lg text-gray-700 text-xs font-bold hover:bg-gray-50 transition-colors">
                        <span>🖨</span> Print
                    </button>

                    {{-- Unduh Dropdown --}}
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
                            <button onclick="unduhPDF()"
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
                <table class="w-full text-xs" id="tabel-pekerjaan">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Mata Pencaharian</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laki-laki</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Perempuan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Total</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['label' => 'Petani / Pekebun',       'l' => '860',  'p' => '380', 'total' => '1.240', 'pct' => '25,5%', 'stripe' => true,  'color' => 'bg-green-700'],
                            ['label' => 'Buruh Harian',           'l' => '540',  'p' => '320', 'total' => '860',   'pct' => '17,7%', 'stripe' => false, 'color' => 'bg-amber-500'],
                            ['label' => 'Wiraswasta',             'l' => '380',  'p' => '260', 'total' => '640',   'pct' => '13,1%', 'stripe' => true,  'color' => 'bg-blue-500'],
                            ['label' => 'Pelajar / Mahasiswa',    'l' => '360',  'p' => '360', 'total' => '720',   'pct' => '14,8%', 'stripe' => false, 'color' => 'bg-violet-500'],
                            ['label' => 'PNS / TNI / Polri',      'l' => '180',  'p' => '100', 'total' => '280',   'pct' => '5,7%',  'stripe' => true,  'color' => 'bg-sky-500'],
                            ['label' => 'Ibu Rumah Tangga',       'l' => '—',    'p' => '402', 'total' => '402',   'pct' => '8,2%',  'stripe' => false, 'color' => 'bg-pink-400'],
                            ['label' => 'Lainnya (pensiun dll)',  'l' => '120',  'p' => '282', 'total' => '402',   'pct' => '8,2%',  'stripe' => true,  'color' => 'bg-gray-500'],
                            ['label' => 'Belum / Tdk Bekerja',    'l' => '160',  'p' => '168', 'total' => '328',   'pct' => '6,7%',  'stripe' => false, 'color' => 'bg-red-400'],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $row['color'] }} flex-shrink-0"></span>
                                    <span class="text-gray-900 font-medium">{{ $row['label'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700">
                                @if($row['l'] === '—') <span class="text-gray-400">—</span> @else {{ $row['l'] }} @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">
                                @if($row['p'] === '—') <span class="text-gray-400">—</span> @else {{ $row['p'] }} @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700 font-semibold">{{ $row['total'] }}</td>
                            <td class="px-6 py-3 text-gray-500">{{ $row['pct'] }}</td>
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
    const ctx = document.getElementById('chartMataPencaharian').getContext('2d');

    const data = {
        labels: ['Petani', 'Buruh', 'Wiraswasta', 'PNS/TNI', 'Pelajar', 'Lainnya'],
        datasets: [{
            data: [1240, 860, 640, 280, 720, 402],
            backgroundColor: [
                '#15803d', // Petani
                '#f59e0b', // Buruh
                '#3b82f6', // Wiraswasta
                '#0ea5e9', // PNS/TNI
                '#8b5cf6', // Pelajar
                '#6b7280'  // Lainnya
            ],
            borderWidth: 2,
            borderColor: '#ffffff',
            hoverOffset: 4
        }]
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => {
                            const val = ctx.parsed;
                            const pct = ((val / 4142) * 100).toFixed(1);
                            return ` ${ctx.label}: ${val.toLocaleString('id-ID')} Jiwa (${pct}%)`;
                        }
                    }
                }
            }
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
        ['Mata Pencaharian', 'Laki-laki', 'Perempuan', 'Total', '%'],
        ['Petani / Pekebun', '860', '380', '1.240', '25.5%'],
        ['Buruh Harian', '540', '320', '860', '17.7%'],
        ['Wiraswasta', '380', '260', '640', '13.1%'],
        ['Pelajar / Mahasiswa', '360', '360', '720', '14.8%'],
        ['PNS / TNI / Polri', '180', '100', '280', '5.7%'],
        ['Ibu Rumah Tangga', '-', '402', '402', '8.2%'],
        ['Lainnya (pensiun dll)', '120', '282', '402', '8.2%'],
        ['Belum / Tdk Bekerja', '160', '168', '328', '6.7%']
    ];
    const csvContent = "\uFEFF" + rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'mata-pencaharian-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-pekerjaan');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim().replace(/\n/g, ' ') + '"');
        csv += cols.join(',') + '\n';
    }
    const csvContent = "\uFEFF" + csv;
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'mata-pencaharian-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhPDF() {
    window.print();
}
</script>
@endpush
