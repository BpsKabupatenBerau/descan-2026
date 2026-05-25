@extends('layouts.app')

@section('title', 'Infografis - Desa Cantik | Kampung Tanjung Perangat')

@section('content')

{{-- ============================================================ --}}
{{-- PAGE HEADER                                                   --}}
{{-- ============================================================ --}}
<div class="px-8 py-4 bg-white border-b border-gray-200">
    <h1 class="text-gray-900 text-2xl font-bold">Infografis</h1>
    <p class="text-gray-500 text-xs mt-0.5">Visualisasi data desa dalam bentuk gambar infografis</p>
</div>

{{-- ============================================================ --}}
{{-- FILTER BAR                                                    --}}
{{-- ============================================================ --}}
<div class="px-8 py-0 bg-white border-b border-gray-200">
    <div class="flex items-center justify-between">
        {{-- Category tabs --}}
        <div class="flex items-center gap-1 py-2">
            @php
            $categories = [
                ['id' => 'semua',         'label' => 'Semua'],
                ['id' => 'kependudukan',  'label' => 'Kependudukan'],
                ['id' => 'kesehatan',     'label' => 'Kesehatan'],
                ['id' => 'pendidikan',    'label' => 'Pendidikan'],
                ['id' => 'ekonomi',       'label' => 'Ekonomi'],
                ['id' => 'infrastruktur', 'label' => 'Infrastruktur'],
            ];
            @endphp

            @foreach($categories as $cat)
            <button
                onclick="filterInfografis('{{ $cat['id'] }}')"
                id="tab-{{ $cat['id'] }}"
                class="px-4 py-1.5 text-xs rounded font-medium transition-colors
                    {{ $cat['id'] === 'semua'
                        ? 'bg-green-700 text-white'
                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
            >
                {{ $cat['label'] }}
            </button>
            @endforeach
        </div>

        {{-- Year dropdown --}}
        <div class="relative">
            <select id="yearFilter" onchange="filterInfografis(null, this.value)"
                class="appearance-none border border-gray-200 bg-white text-gray-500 text-xs px-4 py-1.5 pr-7 rounded focus:outline-none focus:ring-1 focus:ring-green-500 cursor-pointer">
                <option value="semua">Semua Tahun</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
            <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-[10px] pointer-events-none">▾</span>
        </div>
    </div>
</div>

{{-- ============================================================ --}}
{{-- INFOGRAFIS GRID                                               --}}
{{-- ============================================================ --}}
<section class="px-8 py-6 bg-stone-50 min-h-screen">

    @php
    $infografisItems = [
        // Row 1
        ['id' => 1, 'category' => 'kependudukan', 'cat_label' => 'Kependudukan', 'bg' => '#eff6ff',    'accent' => '#3b82f6', 'cat_color' => '#3b82f6', 'cat_bg' => '#eff6ff', 'title' => 'Piramida Penduduk 2024',   'year' => '2024', 'emoji' => '📊'],
        ['id' => 2, 'category' => 'sosial',        'cat_label' => 'Sosial',        'bg' => '#fef2f2',    'accent' => '#ef4444', 'cat_color' => '#ef4444', 'cat_bg' => '#fef2f2', 'title' => 'Peta Kemiskinan Desa',     'year' => '2024', 'emoji' => '📊'],
        ['id' => 3, 'category' => 'infrastruktur', 'cat_label' => 'Infrastruktur', 'bg' => '#fffbeb',    'accent' => '#f59e0b', 'cat_color' => '#f59e0b', 'cat_bg' => '#fffbeb', 'title' => 'Infrastruktur Jalan',      'year' => '2023', 'emoji' => '📊'],
        ['id' => 4, 'category' => 'kesehatan',     'cat_label' => 'Kesehatan',     'bg' => '#f0fdf4',    'accent' => '#15803d', 'cat_color' => '#15803d', 'cat_bg' => '#f0fdf4', 'title' => 'Tingkat Kesehatan Anak',  'year' => '2024', 'emoji' => '📊'],
        // Row 2
        ['id' => 5, 'category' => 'ekonomi',       'cat_label' => 'Ekonomi',       'bg' => '#faf5ff',    'accent' => '#8b5cf6', 'cat_color' => '#8b5cf6', 'cat_bg' => '#faf5ff', 'title' => 'Ekonomi UMKM 2024',       'year' => '2024', 'emoji' => '📊'],
        ['id' => 6, 'category' => 'pendidikan',    'cat_label' => 'Pendidikan',    'bg' => '#f0fdfa',    'accent' => '#14b8a6', 'cat_color' => '#14b8a6', 'cat_bg' => '#f0fdfa', 'title' => 'Fasilitas Pendidikan',    'year' => '2023', 'emoji' => '📊'],
        ['id' => 7, 'category' => 'infrastruktur', 'cat_label' => 'Wilayah',       'bg' => '#fff7ed',    'accent' => '#f97316', 'cat_color' => '#f97316', 'cat_bg' => '#fff7ed', 'title' => 'Batas Wilayah RT/RW',     'year' => '2024', 'emoji' => '📊'],
        ['id' => 8, 'category' => 'kesehatan',     'cat_label' => 'Kesehatan',     'bg' => '#f0f9ff',    'accent' => '#0ea5e9', 'cat_color' => '#0ea5e9', 'cat_bg' => '#f0f9ff', 'title' => 'Distribusi Air Bersih',   'year' => '2023', 'emoji' => '📊'],
    ];
    @endphp

    <div id="infografisGrid" class="grid grid-cols-4 gap-5">
        @foreach($infografisItems as $item)
        <div
            class="infografis-card bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 cursor-pointer group"
            data-category="{{ $item['category'] }}"
            data-year="{{ $item['year'] }}"
            onclick="openModal({{ $item['id'] }})"
        >
            {{-- Colored header --}}
            <div class="relative flex items-center justify-center" style="background: {{ $item['bg'] }}; height: 148px;">
                {{-- Decorative gradient circles --}}
                <div class="absolute inset-0 overflow-hidden opacity-40">
                    <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full" style="background: {{ $item['accent'] }}; opacity: 0.15;"></div>
                    <div class="absolute -bottom-2 -left-2 w-12 h-12 rounded-full" style="background: {{ $item['accent'] }}; opacity: 0.1;"></div>
                </div>
                {{-- Icon box --}}
                <div class="relative z-10 w-16 h-16 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform" style="background: {{ $item['accent'] }}">
                    <span class="text-2xl">{{ $item['emoji'] }}</span>
                </div>
            </div>

            {{-- Divider strip --}}
            <div class="h-1" style="background: {{ $item['bg'] }}"></div>

            {{-- Card footer --}}
            <div class="px-4 py-3">
                <h3 class="text-gray-900 text-xs font-bold leading-snug group-hover:text-green-700 transition-colors">{{ $item['title'] }}</h3>
                <div class="flex items-center justify-between mt-2">
                    <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold" style="background: {{ $item['cat_bg'] }}; color: {{ $item['cat_color'] }}">
                        {{ $item['cat_label'] }}
                    </span>
                    <span class="text-gray-400 text-[10px]">{{ $item['year'] }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Empty state --}}
    <div id="emptyState" class="hidden text-center py-20">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-gray-500 text-sm font-medium">Tidak ada infografis untuk filter ini</p>
        <button onclick="filterInfografis('semua')" class="mt-3 text-green-700 text-xs hover:underline">Tampilkan semua</button>
    </div>

    {{-- ============================================================ --}}
    {{-- PAGINATION                                                    --}}
    {{-- ============================================================ --}}
    <div class="flex items-center justify-center gap-1 mt-8">
        <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-500 text-xs hover:bg-gray-200 transition-colors">←</button>
        <button class="w-8 h-8 flex items-center justify-center rounded bg-green-700 text-white text-xs font-bold">1</button>
        <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-700 text-xs hover:bg-gray-200 transition-colors">2</button>
        <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-700 text-xs hover:bg-gray-200 transition-colors">3</button>
        <button class="w-8 h-8 flex items-center justify-center rounded bg-gray-100 text-gray-500 text-xs hover:bg-gray-200 transition-colors">→</button>
    </div>
</section>

{{-- ============================================================ --}}
{{-- MODAL PREVIEW                                                 --}}
{{-- ============================================================ --}}
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-8" onclick="closeModal(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden" onclick="event.stopPropagation()">
        <div id="modalHeader" class="relative flex items-center justify-center" style="height: 200px;">
            <div id="modalIcon" class="w-20 h-20 rounded-2xl flex items-center justify-center shadow-xl text-3xl"></div>
            <button onclick="closeModal()" class="absolute top-4 right-4 w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-800 text-lg leading-none">×</button>
        </div>
        <div class="px-6 py-5">
            <div class="flex items-center justify-between mb-2">
                <span id="modalBadge" class="inline-block px-2.5 py-0.5 rounded text-xs font-bold"></span>
                <span id="modalYear" class="text-gray-400 text-xs"></span>
            </div>
            <h2 id="modalTitle" class="text-gray-900 text-lg font-bold mt-1"></h2>
            <p class="text-gray-500 text-xs mt-2 leading-relaxed">Infografis ini menampilkan visualisasi data terkini dari Kampung Tanjung Perangat. Data bersumber dari Disdukcapil dan instansi terkait.</p>
            <div class="flex gap-3 mt-5">
                <button class="flex-1 py-2.5 bg-green-700 text-white text-xs font-bold rounded-lg hover:bg-green-800 transition-colors">
                    ⬇ Unduh Infografis
                </button>
                <button onclick="closeModal()" class="px-5 py-2.5 border border-gray-200 text-gray-500 text-xs font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
// -------------------------------------------------------------------
// DATA
// -------------------------------------------------------------------
const items = @json($infografisItems);

let activeCategory = 'semua';
let activeYear     = 'semua';

// -------------------------------------------------------------------
// FILTER
// -------------------------------------------------------------------
function filterInfografis(category, year) {
    if (category !== null) activeCategory = category ?? activeCategory;
    if (year !== undefined) activeYear = year;

    // Update tab UI
    if (category !== null) {
        document.querySelectorAll('[id^="tab-"]').forEach(btn => {
            btn.classList.remove('bg-green-700', 'text-white');
            btn.classList.add('bg-gray-100', 'text-gray-700');
        });
        const activeTab = document.getElementById('tab-' + activeCategory);
        if (activeTab) {
            activeTab.classList.remove('bg-gray-100', 'text-gray-700');
            activeTab.classList.add('bg-green-700', 'text-white');
        }
    }

    // Show/hide cards
    const cards = document.querySelectorAll('.infografis-card');
    let visible = 0;

    cards.forEach(card => {
        const matchCat  = activeCategory === 'semua' || card.dataset.category === activeCategory;
        const matchYear = activeYear === 'semua' || card.dataset.year === activeYear;
        if (matchCat && matchYear) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('emptyState').classList.toggle('hidden', visible > 0);
}

// -------------------------------------------------------------------
// MODAL
// -------------------------------------------------------------------
function openModal(id) {
    const item = items.find(i => i.id === id);
    if (!item) return;

    document.getElementById('modalHeader').style.background = item.bg;
    document.getElementById('modalIcon').style.background   = item.accent;
    document.getElementById('modalIcon').textContent        = item.emoji;
    document.getElementById('modalBadge').textContent       = item.cat_label;
    document.getElementById('modalBadge').style.background  = item.cat_bg;
    document.getElementById('modalBadge').style.color       = item.cat_color;
    document.getElementById('modalTitle').textContent       = item.title;
    document.getElementById('modalYear').textContent        = item.year;

    const overlay = document.getElementById('modalOverlay');
    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal(event) {
    if (event && event.target !== document.getElementById('modalOverlay') && event !== undefined && event.target) {
        // only close if clicking overlay itself or called directly
        if (event.currentTarget !== event.target) return;
    }
    const overlay = document.getElementById('modalOverlay');
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
    document.body.style.overflow = '';
}

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeModal();
});
</script>
@endpush
