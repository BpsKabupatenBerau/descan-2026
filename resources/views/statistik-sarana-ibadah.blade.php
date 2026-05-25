@extends('layouts.app')

@section('title', 'Sarana Ibadah - Sarana & Prasarana | Desa Cantik')

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
        <span class="text-green-700 font-medium">Sarana Ibadah</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $kategori = 'sarana';
        $subpage  = 'sarana-ibadah';

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
            <h1 class="text-gray-900 text-2xl font-bold">Sarana Ibadah</h1>
            <p class="text-gray-500 text-sm mt-1">Data tempat ibadah di Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Unit</span>
                <span>📖 Kemenag 2024</span>
            </div>
        </div>

        {{-- Chart Card (Doughnut Chart) --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <h2 class="text-gray-900 text-base font-bold mb-6">Grafik — Sarana Ibadah</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                {{-- Left: Doughnut Chart --}}
                <div class="relative flex justify-center items-center">
                    <div style="width: 220px; height: 220px;">
                        <canvas id="chartSaranaIbadah"></canvas>
                    </div>
                    {{-- Center Label --}}
                    <div class="absolute flex flex-col justify-center items-center text-center">
                        <span class="text-gray-900 text-3xl font-bold leading-none">13</span>
                        <span class="text-gray-400 text-[10px] uppercase font-bold tracking-wider mt-1">Total Unit</span>
                    </div>
                </div>

                {{-- Right: Legend Grid --}}
                <div class="grid grid-cols-2 gap-4">
                    <!-- Masjid -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-green-700 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Masjid</p>
                                <p class="text-[10px] text-gray-400">4 Unit</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-green-700">30.8%</span>
                    </div>

                    <!-- Musholla -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-teal-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Musholla</p>
                                <p class="text-[10px] text-gray-400">8 Unit</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-teal-600">61.5%</span>
                    </div>

                    <!-- Gereja -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-blue-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Gereja</p>
                                <p class="text-[10px] text-gray-400">1 Unit</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-blue-500">7.7%</span>
                    </div>

                    <!-- Pura -->
                    <div class="flex items-center justify-between p-3.5 bg-gray-50/60 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded bg-amber-500 flex-shrink-0"></span>
                            <div>
                                <p class="text-xs font-semibold text-gray-800">Pura</p>
                                <p class="text-[10px] text-gray-400">0 Unit</p>
                            </div>
                        </div>
                        <span class="text-xs font-bold text-amber-500">0%</span>
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
                    <p class="text-gray-500 text-xs mt-0.5">4 baris data</p>
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
                <table class="w-full text-xs" id="tabel-ibadah">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Fasilitas</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jumlah</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Kapasitas</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Kondisi</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Dusun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['label' => 'Masjid Jami', 'jumlah' => '4', 'kapasitas' => '2.400 jemaah', 'kondisi' => 'Baik', 'dusun' => 'I, II, III, IV', 'stripe' => true,  'color' => 'bg-green-700'],
                            ['label' => 'Musholla',    'jumlah' => '8', 'kapasitas' => '3.200 jemaah', 'kondisi' => 'Baik', 'dusun' => 'Tersebar',      'stripe' => false, 'color' => 'bg-teal-500'],
                            ['label' => 'Gereja',      'jumlah' => '1', 'kapasitas' => '200 jemaah',   'kondisi' => 'Baik', 'dusun' => 'Dusun II',      'stripe' => true,  'color' => 'bg-blue-500'],
                            ['label' => 'Total',       'jumlah' => '13', 'kapasitas' => '5.800 jemaah', 'kondisi' => '—',    'dusun' => '—',             'stripe' => false, 'color' => 'bg-gray-500', 'isTotal' => true],
                        ];
                        @endphp
                        @foreach($rows as $row)
                        <tr class="{{ $row['stripe'] ? 'bg-gray-50/60' : 'bg-white' }} border-t border-gray-100 {{ isset($row['isTotal']) ? 'font-bold bg-gray-50/80' : '' }}">
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $row['color'] }} flex-shrink-0"></span>
                                    <span class="text-gray-900 font-medium">{{ $row['label'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['jumlah'] }}</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['kapasitas'] }}</td>
                            <td class="px-6 py-3">
                                @if($row['kondisi'] === '—')
                                    <span class="text-gray-400">—</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                        {{ $row['kondisi'] }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-gray-700">
                                @if($row['dusun'] === '—')
                                    <span class="text-gray-400">—</span>
                                @else
                                    {{ $row['dusun'] }}
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
    const ctx = document.getElementById('chartSaranaIbadah').getContext('2d');

    const data = {
        labels: ['Masjid', 'Musholla', 'Gereja', 'Pura'],
        datasets: [{
            data: [4, 8, 1, 0],
            backgroundColor: [
                '#15803d', // Green-700
                '#14b8a6', // Teal-500
                '#3b82f6', // Blue-500
                '#f59e0b'  // Amber-500
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
                            const pct = ((val / 13) * 100).toFixed(1);
                            return ` ${ctx.label}: ${val} Unit (${pct}%)`;
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
        ['Fasilitas', 'Jumlah', 'Kapasitas', 'Kondisi', 'Dusun'],
        ['Masjid Jami', '4', '2.400 jemaah', 'Baik', 'I, II, III, IV'],
        ['Musholla', '8', '3.200 jemaah', 'Baik', 'Tersebar'],
        ['Gereja', '1', '200 jemaah', 'Baik', 'Dusun II'],
        ['Total', '13', '5.800 jemaah', '-', '-']
    ];
    const csvContent = "\uFEFF" + rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'sarana-ibadah-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-ibadah');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim().replace(/\n/g, ' ') + '"');
        csv += cols.join(',') + '\n';
    }
    const csvContent = "\uFEFF" + csv;
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'sarana-ibadah-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhPDF() {
    window.print();
}
</script>
@endpush
