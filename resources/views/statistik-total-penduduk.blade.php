@extends('layouts.app')

@section('title', 'Total Penduduk - Kependudukan | Desa Cantik')

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
        <span class="text-green-700 font-medium">Total Penduduk</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $kategori = $kategori ?? 'kependudukan';
        $subpage  = $subpage  ?? 'total-penduduk';

        $kependudukanItems = [
            ['label' => 'Total Penduduk',       'icon' => '👥', 'href' => '/statistik/total-penduduk',       'slug' => 'total-penduduk'],
            ['label' => 'Jumlah KK',             'icon' => '🏠', 'href' => '/statistik/jumlah-kk',             'slug' => 'jumlah-kk'],
            ['label' => 'Tingkat Pendidikan',    'icon' => '📚', 'href' => '/statistik',                       'slug' => 'tingkat-pendidikan'],
            ['label' => 'Jenis Kelamin',         'icon' => '⚤',  'href' => '/statistik/jenis-kelamin',         'slug' => 'jenis-kelamin'],
            ['label' => 'Pertumbuhan Penduduk',  'icon' => '📈', 'href' => '/statistik/pertumbuhan-penduduk',  'slug' => 'pertumbuhan-penduduk'],
            ['label' => 'Usia Produktif',        'icon' => '💪', 'href' => '/statistik/usia-produktif',        'slug' => 'usia-produktif'],
            ['label' => 'Status Perkawinan',     'icon' => '💍', 'href' => '/statistik/status-perkawinan',     'slug' => 'status-perkawinan'],
        ];
        $saranaItems = [
            ['label' => 'Fasilitas Kesehatan',  'icon' => '🏥', 'href' => '/statistik/sarana-prasarana/fasilitas-kesehatan',  'slug' => 'fasilitas-kesehatan'],
            ['label' => 'Fasilitas Pendidikan', 'icon' => '🏫', 'href' => '/statistik/sarana-prasarana/fasilitas-pendidikan', 'slug' => 'fasilitas-pendidikan'],
            ['label' => 'Sarana Ibadah',        'icon' => '🕌', 'href' => '/statistik/sarana-prasarana/sarana-ibadah',        'slug' => 'sarana-ibadah'],
            ['label' => 'Sarana Olahraga',      'icon' => '⚽', 'href' => '/statistik/sarana-prasarana/sarana-olahraga',      'slug' => 'sarana-olahraga'],
            ['label' => 'Infrastruktur Jalan',  'icon' => '🛣️',  'href' => '/statistik/sarana-prasarana/infrastruktur-jalan',  'slug' => 'infrastruktur-jalan'],
        ];
        $ekonomiItems = [
            ['label' => 'UMKM',              'icon' => '🏪', 'href' => '/statistik/ekonomi/umkm',               'slug' => 'umkm'],
            ['label' => 'Mata Pencaharian',   'icon' => '⛏️',  'href' => '/statistik/ekonomi/mata-pencaharian',   'slug' => 'mata-pencaharian'],
            ['label' => 'Pendapatan Desa',    'icon' => '💵', 'href' => '/statistik/ekonomi/pendapatan-desa',    'slug' => 'pendapatan-desa'],
            ['label' => 'Produksi Pertanian', 'icon' => '🌾', 'href' => '/statistik/ekonomi/produksi-pertanian', 'slug' => 'produksi-pertanian'],
            ['label' => 'Kemiskinan',         'icon' => '📉', 'href' => '/statistik/ekonomi/tingkat-kemiskinan', 'slug' => 'tingkat-kemiskinan'],
        ];
        $sidebarTitle = match($kategori) {
            'sarana'  => 'Sarana & Prasarana',
            'ekonomi' => 'Ekonomi',
            default   => 'Kependudukan',
        };
        $sidebarItems = match($kategori) {
            'sarana'  => $saranaItems,
            'ekonomi' => $ekonomiItems,
            default   => $kependudukanItems,
        };
        @endphp

        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $sidebarTitle }}</p>
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
            <h1 class="text-gray-900 text-2xl font-bold">Total Penduduk</h1>
            <p class="text-gray-500 text-sm mt-1">Jumlah seluruh penduduk Kampung Tanjung Perangat berdasarkan tahun</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Jiwa</span>
                <span>📖 Disdukcapil 2024</span>
            </div>
        </div>

        {{-- Stat Cards Row --}}
        <div class="grid grid-cols-4 gap-4">

            {{-- Total Penduduk --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-blue-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Total Penduduk</p>
                        <p class="text-blue-500 text-3xl font-bold leading-none">4.872</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa</p>
                    </div>
                </div>
            </div>

            {{-- Kepala Keluarga --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-green-700 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Kepala Keluarga</p>
                        <p class="text-green-700 text-3xl font-bold leading-none">1.423</p>
                        <p class="text-gray-400 text-[10px] mt-2">KK</p>
                    </div>
                </div>
            </div>

            {{-- Laki-laki --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-sky-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Laki-laki</p>
                        <p class="text-sky-500 text-3xl font-bold leading-none">2.480</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa</p>
                    </div>
                </div>
            </div>

            {{-- Perempuan --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-violet-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Perempuan</p>
                        <p class="text-violet-500 text-3xl font-bold leading-none">2.392</p>
                        <p class="text-gray-400 text-[10px] mt-2">Jiwa</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-gray-900 text-base font-bold">Grafik — Total Penduduk</h2>
            </div>
            <div class="flex items-center gap-4 mb-5">
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-500"></div>
                    <span class="text-gray-700 text-[10px]">Jumlah Penduduk</span>
                </div>
                <span class="text-gray-400 text-[9px]">Satuan: Jiwa</span>
            </div>

            <div class="relative" style="height: 300px;">
                <canvas id="chartTotalPenduduk"></canvas>
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
                            <button onclick="unduhCSV()"
                                class="w-full flex items-center gap-2 px-4 py-2.5 text-xs text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
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
                <table class="w-full text-xs" id="tabel-penduduk">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Tahun</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Laki-laki</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Perempuan</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Total</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Pertumbuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['tahun' => '2020', 'l' => '2.210', 'p' => '2.200', 'total' => '4.410', 'growth' => '-',    'stripe' => true],
                            ['tahun' => '2021', 'l' => '2.280', 'p' => '2.240', 'total' => '4.520', 'growth' => '+2,5%', 'stripe' => false],
                            ['tahun' => '2022', 'l' => '2.350', 'p' => '2.330', 'total' => '4.680', 'growth' => '+3,5%', 'stripe' => true],
                            ['tahun' => '2023', 'l' => '2.410', 'p' => '2.370', 'total' => '4.780', 'growth' => '+2,1%', 'stripe' => false],
                            ['tahun' => '2024', 'l' => '2.480', 'p' => '2.392', 'total' => '4.872', 'growth' => '+1,9%', 'stripe' => true],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3 text-gray-900 font-medium">{{ $row['tahun'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['l'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['p'] }}</td>
                            <td class="px-6 py-3 text-gray-700 font-semibold">{{ $row['total'] }}</td>
                            <td class="px-6 py-3">
                                @if($row['growth'] === '-')
                                    <span class="text-gray-400">—</span>
                                @else
                                    <span class="text-green-600 font-semibold">{{ $row['growth'] }}</span>
                                @endif
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
    const ctx = document.getElementById('chartTotalPenduduk').getContext('2d');

    const years  = ['2020', '2021', '2022', '2023', '2024'];
    const values = [4410,   4520,   4680,   4780,   4872];

    // Gradient fill
    const gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0,   'rgba(59,130,246,0.18)');
    gradient.addColorStop(1,   'rgba(59,130,246,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: 'Jumlah Penduduk',
                data: values,
                borderColor: '#3b82f6',
                borderWidth: 2.5,
                backgroundColor: gradient,
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#3b82f6',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ' + ctx.parsed.y.toLocaleString('id-ID') + ' Jiwa'
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 11 }, color: '#6b7280' },
                    border: { display: false }
                },
                y: {
                    beginAtZero: false,
                    min: 4300,
                    max: 5000,
                    ticks: {
                        stepSize: 115,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => val.toLocaleString('id-ID'),
                    },
                    grid: { color: '#f3f4f6', lineWidth: 1 },
                    border: { display: false, dash: [4, 4] }
                }
            },
            animation: { duration: 900, easing: 'easeInOutQuart' }
        }
    });
})();

// Unduh dropdown toggle
function toggleUnduhDropdown() {
    const menu = document.getElementById('unduh-menu');
    menu.classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('unduh-wrapper');
    const menu    = document.getElementById('unduh-menu');
    if (wrapper && !wrapper.contains(e.target)) {
        menu.classList.add('hidden');
    }
});

// Unduh CSV
function unduhCSV() {
    const rows = [
        ['Tahun', 'Laki-laki', 'Perempuan', 'Total', 'Pertumbuhan'],
        ['2020', '2210', '2200', '4410', '-'],
        ['2021', '2280', '2240', '4520', '+2.5%'],
        ['2022', '2350', '2330', '4680', '+3.5%'],
        ['2023', '2410', '2370', '4780', '+2.1%'],
        ['2024', '2480', '2392', '4872', '+1.9%'],
    ];
    const csv  = rows.map(r => r.join(',')).join('\n');
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'total-penduduk.csv';
    a.click();
}

// Unduh Excel (simple CSV with .xlsx extension workaround via data URI)
function unduhExcel() {
    const table = document.getElementById('tabel-penduduk');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim() + '"');
        csv += cols.join(',') + '\n';
    }
    const blob = new Blob([csv], { type: 'text/csv' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'total-penduduk.csv';
    a.click();
}
</script>
@endpush
