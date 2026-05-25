@extends('layouts.app')

@section('title', 'Fasilitas Kesehatan - Sarana & Prasarana | Desa Cantik')

@section('content')

{{-- BREADCRUMB --}}
<div class="px-8 py-3 bg-stone-50 border-b border-gray-200">
    <nav class="flex items-center gap-2 text-xs text-gray-500">
        <a href="{{ url('/') }}" class="hover:text-green-700 transition-colors">Beranda</a>
        <span class="text-gray-300">›</span>
        <a href="{{ url('/statistik') }}" class="hover:text-green-700 transition-colors">Statistik</a>
        <span class="text-gray-300">›</span>
        <span class="text-gray-500">Sarana</span>
        <span class="text-gray-300">›</span>
        <span class="text-green-700 font-medium">Fasilitas Kesehatan</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $kategori = 'sarana';
        $subpage  = 'fasilitas-kesehatan';

        $saranaItems = [
            ['label' => 'Fasilitas Kesehatan',  'icon' => '🏥', 'href' => '/statistik/sarana-prasarana/fasilitas-kesehatan',  'slug' => 'fasilitas-kesehatan'],
            ['label' => 'Fasilitas Pendidikan', 'icon' => '🏫', 'href' => '/statistik/sarana-prasarana/fasilitas-pendidikan', 'slug' => 'fasilitas-pendidikan'],
            ['label' => 'Sarana Ibadah',        'icon' => '🕌', 'href' => '/statistik/sarana-prasarana/sarana-ibadah',        'slug' => 'sarana-ibadah'],
            ['label' => 'Sarana Olahraga',      'icon' => '⚽', 'href' => '/statistik/sarana-prasarana/sarana-olahraga',      'slug' => 'sarana-olahraga'],
            ['label' => 'Infrastruktur Jalan',  'icon' => '🛣️',  'href' => '/statistik/sarana-prasarana/infrastruktur-jalan',  'slug' => 'infrastruktur-jalan'],
        ];
        @endphp

        <div class="px-5 mb-2">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">Sarana & Prasarana</p>
        </div>
        <nav>
            @foreach($saranaItems as $item)
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
                Sarana
            </div>
            <h1 class="text-gray-900 text-2xl font-bold">Fasilitas Kesehatan</h1>
            <p class="text-gray-500 text-sm mt-1">Sarana dan prasarana kesehatan di Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Unit / Orang</span>
                <span>📖 Puskesmas 2024</span>
            </div>
        </div>

        {{-- Stat Cards Row --}}
        <div class="grid grid-cols-5 gap-4">

            {{-- Puskesmas --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-red-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Puskesmas</p>
                        <p class="text-red-500 text-3xl font-bold leading-none">1</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

            {{-- Posyandu --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-green-700 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Posyandu</p>
                        <p class="text-green-700 text-3xl font-bold leading-none">3</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

            {{-- Bidan Desa --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-sky-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Bidan Desa</p>
                        <p class="text-sky-500 text-3xl font-bold leading-none">2</p>
                        <p class="text-gray-400 text-[10px] mt-2">Orang</p>
                    </div>
                </div>
            </div>

            {{-- Apotek --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-violet-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Apotek</p>
                        <p class="text-violet-500 text-3xl font-bold leading-none">1</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

            {{-- Polindes --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-amber-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Polindes</p>
                        <p class="text-amber-500 text-3xl font-bold leading-none">1</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-gray-900 text-base font-bold">Grafik — Fasilitas Kesehatan</h2>
            </div>
            <div class="flex items-center gap-4 mb-5">
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-700"></div>
                    <span class="text-gray-700 text-[10px]">Jumlah Fasilitas</span>
                </div>
                <span class="text-gray-400 text-[9px]">Satuan: Unit/Orang</span>
            </div>

            <div class="relative" style="height: 320px;">
                <canvas id="chartFasilitasKesehatan"></canvas>
            </div>
        </div>

        {{-- Data Tabel --}}
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">

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
                <table class="w-full text-xs" id="tabel-kesehatan">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Fasilitas</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jumlah</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Lokasi / Dusun</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Kondisi</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['label' => 'Puskesmas',   'jumlah' => '1 Unit',  'lokasi' => 'Dusun I',        'kondisi' => 'Baik', 'keterangan' => 'Beroperasi 6 hari/minggu', 'stripe' => true,  'color' => 'bg-red-500'],
                            ['label' => 'Posyandu',    'jumlah' => '3 Unit',  'lokasi' => 'Dusun I, II, III','kondisi' => 'Baik', 'keterangan' => 'Aktif bulanan',             'stripe' => false, 'color' => 'bg-green-700'],
                            ['label' => 'Bidan Desa',  'jumlah' => '2 Orang', 'lokasi' => 'Dusun II, IV',    'kondisi' => 'Baik', 'keterangan' => 'Siaga 24 jam',              'stripe' => true,  'color' => 'bg-sky-500'],
                            ['label' => 'Apotek',      'jumlah' => '1 Unit',  'lokasi' => 'Dusun I',        'kondisi' => 'Baik', 'keterangan' => 'Bermitra BPJS',             'stripe' => false, 'color' => 'bg-violet-500'],
                            ['label' => 'Polindes',    'jumlah' => '1 Unit',  'lokasi' => 'Dusun III',      'kondisi' => 'Baik', 'keterangan' => 'Pelayanan dasar',           'stripe' => true,  'color' => 'bg-amber-500'],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full {{ $row['color'] }} flex-shrink-0"></span>
                                    <span class="text-gray-900 font-medium">{{ $row['label'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['jumlah'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['lokasi'] }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                    {{ $row['kondisi'] }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['keterangan'] }}</td>
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
    const ctx = document.getElementById('chartFasilitasKesehatan').getContext('2d');

    const labels = ['Puskesmas', 'Posyandu', 'Bidan Desa', 'Apotek', 'Polindes'];
    const values = [1, 3, 2, 1, 1];
    const colors = {
        bg:     ['rgba(239,68,68,0.85)', 'rgba(21,128,61,0.85)', 'rgba(56,189,248,0.85)', 'rgba(139,92,246,0.85)', 'rgba(245,158,11,0.85)'],
        border: ['#ef4444',              '#15803d',              '#38bdf8',              '#8b5cf6',              '#f59e0b'],
    };

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Jumlah',
                data: values,
                backgroundColor: colors.bg,
                borderColor:     colors.border,
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
                        label: ctx => {
                            const label = ctx.label || '';
                            const val = ctx.parsed.y;
                            const unit = label === 'Bidan Desa' ? ' Orang' : ' Unit';
                            return ' ' + val + unit;
                        }
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
                    max: 4,
                    ticks: {
                        stepSize: 1,
                        font: { family: 'Inter', size: 10 },
                        color: '#9ca3af',
                        callback: val => val,
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
        ['Fasilitas', 'Jumlah', 'Lokasi / Dusun', 'Kondisi', 'Keterangan'],
        ['Puskesmas', '1 Unit', 'Dusun I', 'Baik', 'Beroperasi 6 hari/minggu'],
        ['Posyandu', '3 Unit', 'Dusun I, II, III', 'Baik', 'Aktif bulanan'],
        ['Bidan Desa', '2 Orang', 'Dusun II, IV', 'Baik', 'Siaga 24 jam'],
        ['Apotek', '1 Unit', 'Dusun I', 'Baik', 'Bermitra BPJS'],
        ['Polindes', '1 Unit', 'Dusun III', 'Baik', 'Pelayanan dasar']
    ];
    // Add BOM for Excel compatibility in UTF-8
    const csvContent = "\uFEFF" + rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'fasilitas-kesehatan-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-kesehatan');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim().replace(/\n/g, ' ') + '"');
        csv += cols.join(',') + '\n';
    }
    const csvContent = "\uFEFF" + csv;
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'fasilitas-kesehatan-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhPDF() {
    window.print();
}
</script>
@endpush
