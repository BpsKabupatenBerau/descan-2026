@extends('layouts.app')

@section('title', 'Fasilitas Pendidikan - Sarana & Prasarana | Desa Cantik')

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
        <span class="text-green-700 font-medium">Fasilitas Pendidikan</span>
    </nav>
</div>

{{-- MAIN LAYOUT --}}
<div class="flex min-h-screen bg-stone-50">

    {{-- SIDEBAR --}}
    <aside class="w-60 flex-shrink-0 bg-white border-r border-gray-200 pt-4 pb-8">
        @php
        $kategori = 'sarana';
        $subpage  = 'fasilitas-pendidikan';

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
            <h1 class="text-gray-900 text-2xl font-bold">Fasilitas Pendidikan</h1>
            <p class="text-gray-500 text-sm mt-1">Sarana pendidikan formal dan non-formal di Kampung Tanjung Perangat</p>
            <div class="flex items-center gap-6 mt-3 text-xs text-gray-400">
                <span>📅 Tahun 2024</span>
                <span>📏 Unit / Sekolah</span>
                <span>📖 Dinas Pendidikan 2024</span>
            </div>
        </div>

        {{-- Stat Cards Row --}}
        <div class="grid grid-cols-5 gap-4">

            {{-- SD / MI --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-blue-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">SD / MI</p>
                        <p class="text-blue-500 text-3xl font-bold leading-none">3</p>
                        <p class="text-gray-400 text-[10px] mt-2">Sekolah</p>
                    </div>
                </div>
            </div>

            {{-- SMP / MTs --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-green-700 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">SMP / MTs</p>
                        <p class="text-green-700 text-3xl font-bold leading-none">2</p>
                        <p class="text-gray-400 text-[10px] mt-2">Sekolah</p>
                    </div>
                </div>
            </div>

            {{-- TK / PAUD --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-amber-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">TK / PAUD</p>
                        <p class="text-amber-500 text-3xl font-bold leading-none">2</p>
                        <p class="text-gray-400 text-[10px] mt-2">Sekolah</p>
                    </div>
                </div>
            </div>

            {{-- Pesantren --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-violet-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">Pesantren</p>
                        <p class="text-violet-500 text-3xl font-bold leading-none">1</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

            {{-- TPQ --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <div class="w-1 h-12 bg-teal-500 rounded-full flex-shrink-0 mt-0.5"></div>
                    <div>
                        <p class="text-gray-500 text-xs mb-1">TPQ</p>
                        <p class="text-teal-500 text-3xl font-bold leading-none">4</p>
                        <p class="text-gray-400 text-[10px] mt-2">Unit</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Chart Card --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between mb-1">
                <h2 class="text-gray-900 text-base font-bold">Grafik — Fasilitas Pendidikan</h2>
            </div>
            <div class="flex items-center gap-4 mb-5">
                <div class="flex items-center gap-1.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-green-700"></div>
                    <span class="text-gray-700 text-[10px]">Jumlah Fasilitas</span>
                </div>
                <span class="text-gray-400 text-[9px]">Satuan: Unit / Sekolah</span>
            </div>

            <div class="relative" style="height: 320px;">
                <canvas id="chartFasilitasPendidikan"></canvas>
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
                <table class="w-full text-xs" id="tabel-pendidikan">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Fasilitas</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Jumlah</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Siswa</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Guru</th>
                            <th class="text-left px-6 py-3 text-gray-500 font-bold">Akreditasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $rows = [
                            ['label' => 'PAUD / TK',   'jumlah' => '2 Sekolah', 'siswa' => '86',  'guru' => '8',  'akreditasi' => 'B',          'stripe' => true,  'color' => 'bg-amber-500'],
                            ['label' => 'SD / MI',     'jumlah' => '3 Sekolah', 'siswa' => '642', 'guru' => '36', 'akreditasi' => 'A / B / B',  'stripe' => false, 'color' => 'bg-blue-500'],
                            ['label' => 'SMP / MTs',   'jumlah' => '2 Sekolah', 'siswa' => '410', 'guru' => '28', 'akreditasi' => 'A / B',      'stripe' => true,  'color' => 'bg-green-700'],
                            ['label' => 'Pesantren',   'jumlah' => '1 Unit',    'siswa' => '180', 'guru' => '12', 'akreditasi' => 'Terdaftar',  'stripe' => false, 'color' => 'bg-violet-500'],
                            ['label' => 'TPQ',         'jumlah' => '4 Unit',    'siswa' => '320', 'guru' => '20', 'akreditasi' => '—',          'stripe' => true,  'color' => 'bg-teal-500'],
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
                            <td class="px-6 py-3 text-gray-700">{{ $row['siswa'] }} Jiwa</td>
                            <td class="px-6 py-3 text-gray-700">{{ $row['guru'] }} Orang</td>
                            <td class="px-6 py-3">
                                @if($row['akreditasi'] === '—')
                                    <span class="text-gray-400">—</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                        {{ $row['akreditasi'] }}
                                    </span>
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
    const ctx = document.getElementById('chartFasilitasPendidikan').getContext('2d');

    const labels = ['PAUD/TK', 'SD/MI', 'SMP/MTs', 'Pesantren', 'TPQ'];
    const values = [2, 3, 2, 1, 4];
    const colors = {
        bg:     ['rgba(245,158,11,0.85)', 'rgba(59,130,246,0.85)', 'rgba(21,128,61,0.85)', 'rgba(139,92,246,0.85)', 'rgba(20,184,166,0.85)'],
        border: ['#f59e0b',              '#3b82f6',              '#15803d',              '#8b5cf6',              '#14b8a6'],
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
                            const unit = (label === 'PAUD/TK' || label === 'SD/MI' || label === 'SMP/MTs') ? ' Sekolah' : ' Unit';
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
                    max: 5,
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
        ['Fasilitas', 'Jumlah', 'Siswa', 'Guru', 'Akreditasi'],
        ['PAUD / TK', '2 Sekolah', '86', '8', 'B'],
        ['SD / MI', '3 Sekolah', '642', '36', 'A / B / B'],
        ['SMP / MTs', '2 Sekolah', '410', '28', 'A / B'],
        ['Pesantren', '1 Unit', '180', '12', 'Terdaftar'],
        ['TPQ', '4 Unit', '320', '20', '-']
    ];
    const csvContent = "\uFEFF" + rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'fasilitas-pendidikan-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhExcel() {
    const table = document.getElementById('tabel-pendidikan');
    let csv = '';
    for (const row of table.rows) {
        const cols = Array.from(row.cells).map(c => '"' + c.innerText.trim().replace(/\n/g, ' ') + '"');
        csv += cols.join(',') + '\n';
    }
    const csvContent = "\uFEFF" + csv;
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const a    = document.createElement('a');
    a.href     = URL.createObjectURL(blob);
    a.download = 'fasilitas-pendidikan-kampung-tanjung-perangat.csv';
    a.click();
}

function unduhPDF() {
    window.print();
}
</script>
@endpush
