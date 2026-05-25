@extends('layouts.app')

@section('title', 'Jenis Kelamin - Kependudukan | Desa Cantik')

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
        <span class="text-green-700 font-medium">Jenis Kelamin</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $subpage = $subpage ?? 'jenis-kelamin';
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
            <h1 class="text-gray-900 text-2xl font-bold">Jenis Kelamin</h1>
            <p class="text-gray-500 text-sm mt-1">Komposisi penduduk berdasarkan jenis kelamin</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-gray-900 text-base font-bold mb-6">Grafik — Jenis Kelamin</h2>

            <div class="flex items-center justify-center gap-16">

                {{-- Donut Chart --}}
                <div class="relative flex-shrink-0" style="width: 280px; height: 280px;">
                    <canvas id="chartJenisKelamin"></canvas>
                    {{-- Center Label --}}
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-gray-900 text-xl font-bold">4.872</span>
                        <span class="text-gray-500 text-[10px] mt-0.5">Total</span>
                    </div>
                </div>

                {{-- Legend & Stats --}}
                <div class="space-y-6">
                    {{-- Laki-laki --}}
                    <div class="flex items-center gap-4">
                        <div class="w-4 h-4 rounded bg-blue-500 flex-shrink-0"></div>
                        <div>
                            <p class="text-gray-700 text-sm font-semibold">Laki-laki</p>
                            <p class="text-blue-500 text-2xl font-bold leading-none mt-0.5">2.480</p>
                            <p class="text-gray-400 text-xs mt-1">50,9% dari total penduduk</p>
                        </div>
                    </div>
                    {{-- Perempuan --}}
                    <div class="flex items-center gap-4">
                        <div class="w-4 h-4 rounded bg-violet-500 flex-shrink-0"></div>
                        <div>
                            <p class="text-gray-700 text-sm font-semibold">Perempuan</p>
                            <p class="text-violet-500 text-2xl font-bold leading-none mt-0.5">2.392</p>
                            <p class="text-gray-400 text-xs mt-1">49,1% dari total penduduk</p>
                        </div>
                    </div>
                    {{-- Rasio --}}
                    <div class="bg-gray-50 rounded-xl px-5 py-3 border border-gray-100">
                        <p class="text-gray-400 text-[10px] font-bold uppercase tracking-wide mb-1">Rasio Jenis Kelamin</p>
                        <p class="text-gray-900 text-lg font-bold">103,7</p>
                        <p class="text-gray-500 text-[10px]">Laki-laki per 100 Perempuan</p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Data Tabel --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">

            {{-- Table Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div>
                    <h2 class="text-gray-900 text-sm font-bold">Data Tabel</h2>
                    <p class="text-gray-500 text-xs mt-0.5">3 baris data</p>
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
                <table class="w-full text-xs" id="tabel-jenis-kelamin">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jenis Kelamin</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jumlah</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Persentase</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Usia 0–14</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Usia 15–64</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Usia 65+</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['label' => 'Laki-laki',  'color' => 'bg-blue-500',   'jumlah' => '2.480', 'pct' => '50,9%', 'u1' => '490',   'u2' => '1.780', 'u3' => '210',  'stripe' => true,  'bold' => false],
                            ['label' => 'Perempuan',  'color' => 'bg-violet-500', 'jumlah' => '2.392', 'pct' => '49,1%', 'u1' => '467',   'u2' => '1.712', 'u3' => '213',  'stripe' => false, 'bold' => false],
                            ['label' => 'Total',      'color' => 'bg-gray-400',   'jumlah' => '4.872', 'pct' => '100%',  'u1' => '957',   'u2' => '3.492', 'u3' => '423',  'stripe' => true,  'bold' => true],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $row['color'] }} flex-shrink-0"></span>
                                    <span class="{{ $row['bold'] ? 'text-gray-900 font-bold' : 'text-gray-900 font-medium' }}">{{ $row['label'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700 {{ $row['bold'] ? 'font-bold' : '' }}">{{ $row['jumlah'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['pct'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['u1'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['u2'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['u3'] }}</td>
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
    const ctx = document.getElementById('chartJenisKelamin').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [2480, 2392],
                backgroundColor: ['rgba(59,130,246,0.90)', 'rgba(139,92,246,0.90)'],
                borderColor:     ['#3b82f6', '#8b5cf6'],
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
        ['Jenis Kelamin', 'Jumlah', 'Persentase', 'Usia 0-14', 'Usia 15-64', 'Usia 65+'],
        ['Laki-laki',  2480, '50.9%', 490, 1780, 210],
        ['Perempuan',  2392, '49.1%', 467, 1712, 213],
        ['Total',      4872, '100%',  957, 3492, 423],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'jenis-kelamin.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-jenis-kelamin');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'jenis-kelamin.csv';
    a.click();
}
</script>
@endpush
