@extends('layouts.app')

@section('title', 'Publikasi & Dokumen - Desa Cantik | Kampung Tanjung Perangat')

@section('content')

{{-- ============================================================ --}}
{{-- PAGE HEADER                                                   --}}
{{-- ============================================================ --}}
<div class="px-8 py-4 bg-white border-b border-gray-200">
    <h1 class="text-gray-900 text-2xl font-bold">Publikasi &amp; Dokumen</h1>
    <p class="text-gray-500 text-xs mt-0.5">Laporan, monografi, peraturan, dan dokumen resmi desa</p>
</div>

{{-- ============================================================ --}}
{{-- SEARCH & FILTER BAR                                          --}}
{{-- ============================================================ --}}
<div class="px-8 py-0 bg-white border-b border-gray-200">
    <form id="searchForm" onsubmit="doSearch(event)" class="flex items-center gap-3 py-3">
        {{-- Search --}}
        <div class="relative flex-1 max-w-xl">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none">🔍</span>
            <input
                id="searchInput"
                type="text"
                placeholder="Cari judul dokumen..."
                class="w-full bg-gray-100 border-0 rounded pl-9 pr-4 py-2 text-xs text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:bg-white transition-colors"
            >
        </div>

        {{-- Category --}}
        <div class="relative">
            <select id="catFilter" class="appearance-none bg-gray-100 border-0 rounded pl-3 pr-7 py-2 text-xs text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 cursor-pointer">
                <option value="">Semua Kategori</option>
                <option value="Monografi">Monografi</option>
                <option value="Laporan Keuangan">Laporan Keuangan</option>
                <option value="Profil">Profil</option>
                <option value="Peraturan Desa">Peraturan Desa</option>
                <option value="RKPD">RKPD</option>
                <option value="Data Potensi">Data Potensi</option>
            </select>
            <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] pointer-events-none">▾</span>
        </div>

        {{-- Year --}}
        <div class="relative">
            <select id="yearFilter" class="appearance-none bg-gray-100 border-0 rounded pl-3 pr-7 py-2 text-xs text-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500 cursor-pointer">
                <option value="">Semua Tahun</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
            <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] pointer-events-none">▾</span>
        </div>

        {{-- Search button --}}
        <button type="submit" class="px-6 py-2 bg-green-700 text-white text-xs font-bold rounded hover:bg-green-800 transition-colors">
            Cari
        </button>
    </form>
</div>

{{-- ============================================================ --}}
{{-- DOCUMENT LIST                                                 --}}
{{-- ============================================================ --}}
<section class="px-8 py-6 bg-stone-50 min-h-screen">

    @php
    $documents = [
        [
            'title'     => 'Monografi Kampung Tanjung Perangat 2024',
            'category'  => 'Monografi',
            'year'      => '2024',
            'author'    => 'Admin Desa',
            'size'      => '2.4 MB',
            'downloads' => '1.234',
            'date'      => '12 Jan 2024',
        ],
        [
            'title'     => 'Laporan Realisasi APBDes 2023',
            'category'  => 'Laporan Keuangan',
            'year'      => '2023',
            'author'    => 'Bendahara Desa',
            'size'      => '1.8 MB',
            'downloads' => '876',
            'date'      => '15 Feb 2024',
        ],
        [
            'title'     => 'Profil Kampung Tanjung Perangat 2024',
            'category'  => 'Profil',
            'year'      => '2024',
            'author'    => 'Sekdes',
            'size'      => '5.2 MB',
            'downloads' => '2.105',
            'date'      => '20 Mar 2024',
        ],
        [
            'title'     => 'Perdes No. 3/2023 Tata Ruang',
            'category'  => 'Peraturan Desa',
            'year'      => '2023',
            'author'    => 'Kades',
            'size'      => '0.9 MB',
            'downloads' => '543',
            'date'      => '01 Apr 2023',
        ],
        [
            'title'     => 'Rencana Kerja Pemerintah Desa 2024',
            'category'  => 'RKPD',
            'year'      => '2024',
            'author'    => 'Kaur Perencanaan',
            'size'      => '3.1 MB',
            'downloads' => '1.067',
            'date'      => '10 Des 2023',
        ],
        [
            'title'     => 'Data Potensi Desa 2024',
            'category'  => 'Data Potensi',
            'year'      => '2024',
            'author'    => 'Admin Desa',
            'size'      => '4.6 MB',
            'downloads' => '789',
            'date'      => '05 Jan 2024',
        ],
    ];
    @endphp

    <div id="docList" class="space-y-2">
        @foreach($documents as $i => $doc)
        <div
            class="doc-row bg-white border border-gray-200 rounded-xl px-5 py-4 flex items-center gap-4 hover:shadow-sm hover:border-gray-300 transition-all"
            data-category="{{ $doc['category'] }}"
            data-year="{{ $doc['year'] }}"
            data-title="{{ strtolower($doc['title']) }}"
        >
            {{-- PDF Icon --}}
            <div class="flex-shrink-0 w-11 h-12 relative flex items-center justify-center">
                <div class="absolute inset-0 bg-red-500 opacity-10 rounded"></div>
                <div class="absolute inset-0 border border-red-300 opacity-40 rounded"></div>
                <div class="relative flex flex-col items-center justify-center h-full">
                    <span class="text-red-500 text-[9px] font-bold leading-none">PDF</span>
                    <span class="text-base leading-none mt-0.5">📄</span>
                </div>
            </div>

            {{-- Main content --}}
            <div class="flex-1 min-w-0">
                <h3 class="text-gray-900 text-sm font-bold truncate">{{ $doc['title'] }}</h3>
                <div class="flex items-center flex-wrap gap-3 mt-1.5">
                    <span class="inline-block bg-blue-50 text-blue-500 text-[10px] font-bold px-2 py-0.5 rounded">
                        {{ $doc['category'] }}
                    </span>
                    <span class="text-gray-400 text-[10px]">📅 {{ $doc['year'] }}</span>
                    <span class="text-gray-400 text-[10px]">✍️ {{ $doc['author'] }}</span>
                    <span class="text-gray-400 text-[10px]">📦 {{ $doc['size'] }}</span>
                    <span class="text-gray-400 text-[10px]">⬇ {{ $doc['downloads'] }} unduhan</span>
                </div>
            </div>

            {{-- Date --}}
            <span class="flex-shrink-0 text-gray-400 text-xs hidden lg:block">{{ $doc['date'] }}</span>

            {{-- Download button --}}
            <a href="#" class="flex-shrink-0 flex items-center gap-1.5 px-4 py-2 bg-green-700 text-white text-xs font-bold rounded-lg hover:bg-green-800 transition-colors whitespace-nowrap">
                ⬇ Unduh
            </a>
        </div>
        @endforeach
    </div>

    {{-- Empty state --}}
    <div id="emptyState" class="hidden text-center py-20">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-gray-500 text-sm font-medium">Tidak ada dokumen yang ditemukan</p>
        <button onclick="resetSearch()" class="mt-3 text-green-700 text-xs hover:underline">Reset pencarian</button>
    </div>

    {{-- ============================================================ --}}
    {{-- RESULT COUNT                                                  --}}
    {{-- ============================================================ --}}
    <div class="flex items-center justify-between mt-5">
        <p id="resultCount" class="text-gray-400 text-xs">Menampilkan <span id="countNum">6</span> dokumen</p>

        {{-- Pagination --}}
        <div class="flex items-center gap-1">
            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-500 text-xs hover:bg-gray-200 transition-colors">←</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-green-700 text-white text-xs font-bold">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-700 text-xs hover:bg-gray-200 transition-colors">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-700 text-xs hover:bg-gray-200 transition-colors">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-400 text-xs cursor-default">...</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-700 text-xs hover:bg-gray-200 transition-colors">12</button>
            <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-500 text-xs hover:bg-gray-200 transition-colors">→</button>
        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
function doSearch(e) {
    if (e) e.preventDefault();

    const query   = document.getElementById('searchInput').value.toLowerCase().trim();
    const cat     = document.getElementById('catFilter').value;
    const year    = document.getElementById('yearFilter').value;

    const rows = document.querySelectorAll('.doc-row');
    let visible = 0;

    rows.forEach(row => {
        const matchTitle = !query || row.dataset.title.includes(query);
        const matchCat   = !cat   || row.dataset.category === cat;
        const matchYear  = !year  || row.dataset.year === year;

        if (matchTitle && matchCat && matchYear) {
            row.style.display = '';
            visible++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('countNum').textContent = visible;
    document.getElementById('emptyState').classList.toggle('hidden', visible > 0);
}

function resetSearch() {
    document.getElementById('searchInput').value = '';
    document.getElementById('catFilter').value   = '';
    document.getElementById('yearFilter').value  = '';
    doSearch();
}

// Live search on input change
document.getElementById('searchInput').addEventListener('input', () => doSearch());
document.getElementById('catFilter').addEventListener('change',  () => doSearch());
document.getElementById('yearFilter').addEventListener('change', () => doSearch());
</script>
@endpush
