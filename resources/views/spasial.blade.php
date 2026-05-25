@extends('layouts.app')

@section('title', 'Peta Spasial - Desa Cantik | Kampung Tanjung Perangat')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
<style>
    #map { width: 100%; height: 100%; min-height: 600px; z-index: 1; }
    .leaflet-popup-content-wrapper { border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
    .leaflet-popup-content { margin: 12px 14px; font-family: 'Inter', sans-serif; }
    .marker-pin {
        width: 24px; height: 24px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.25);
        border: 2px solid white;
    }
    .filter-item { cursor: pointer; transition: background 0.15s; }
    .filter-item:hover { background: #f9fafb; }
    .filter-item.active { background: #dcfce7; }
</style>
@endpush

@section('content')

{{-- ============================================================ --}}
{{-- PAGE HEADER                                                   --}}
{{-- ============================================================ --}}
<div class="px-8 py-4 bg-white border-b border-gray-200">
    <h1 class="text-gray-900 text-2xl font-bold">Peta Spasial</h1>
    <p class="text-gray-500 text-xs mt-0.5">Peta interaktif fasilitas dan sarana di wilayah desa</p>
</div>

{{-- ============================================================ --}}
{{-- MAIN LAYOUT: SIDEBAR + MAP                                   --}}
{{-- ============================================================ --}}
<div class="flex bg-stone-50" style="height: calc(100vh - 130px); min-height: 680px;">

    {{-- ========================================================= --}}
    {{-- SIDEBAR FILTER                                             --}}
    {{-- ========================================================= --}}
    <aside class="w-64 flex-shrink-0 bg-white border-r border-gray-200 flex flex-col overflow-y-auto">

        <div class="px-5 pt-5 pb-3">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-3">Filter Kategori</p>

            @php
            $filters = [
                ['id' => 'all',          'color' => '#6b7280', 'label' => 'Semua Lokasi',  'count' => 18, 'active' => true],
                ['id' => 'pemerintahan', 'color' => '#3b82f6', 'label' => 'Pemerintahan',  'count' => 3,  'active' => false],
                ['id' => 'kesehatan',    'color' => '#15803d', 'label' => 'Kesehatan',      'count' => 5,  'active' => false],
                ['id' => 'pendidikan',   'color' => '#f59e0b', 'label' => 'Pendidikan',     'count' => 7,  'active' => false],
                ['id' => 'ibadah',       'color' => '#8b5cf6', 'label' => 'Sarana Ibadah',  'count' => 9,  'active' => false],
                ['id' => 'perbankan',    'color' => '#14b8a6', 'label' => 'Perbankan',      'count' => 4,  'active' => false],
            ];
            @endphp

            <div class="space-y-1">
                @foreach($filters as $filter)
                <button
                    onclick="filterMarkers('{{ $filter['id'] }}')"
                    id="filter-{{ $filter['id'] }}"
                    class="filter-item w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-left {{ $filter['active'] ? 'active' : '' }}"
                >
                    <div class="flex items-center gap-3">
                        <span class="w-3.5 h-3.5 rounded-full flex-shrink-0" style="background: {{ $filter['color'] }}"></span>
                        <span class="text-xs {{ $filter['active'] ? 'text-green-700 font-bold' : 'text-gray-700 font-normal' }}" id="filter-label-{{ $filter['id'] }}">
                            {{ $filter['label'] }}
                        </span>
                    </div>
                    <span class="bg-gray-100 text-gray-500 text-xs font-bold px-2 py-0.5 rounded" id="filter-count-{{ $filter['id'] }}">
                        {{ $filter['count'] }}
                    </span>
                </button>
                @endforeach
            </div>
        </div>

        {{-- LEGENDA --}}
        <div class="px-5 pt-4 mt-auto border-t border-gray-100 pb-5">
            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mb-3">Legenda</p>
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <span class="w-3 h-3 rounded-full bg-blue-500 flex-shrink-0"></span> Pemerintahan
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <span class="w-3 h-3 rounded-full bg-green-700 flex-shrink-0"></span> Kesehatan
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <span class="w-3 h-3 rounded-full bg-amber-500 flex-shrink-0"></span> Pendidikan
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <span class="w-3 h-3 rounded-full bg-violet-500 flex-shrink-0"></span> Sarana Ibadah
                </div>
                <div class="flex items-center gap-2 text-xs text-gray-600">
                    <span class="w-3 h-3 rounded-full bg-teal-500 flex-shrink-0"></span> Perbankan
                </div>
            </div>
        </div>

    </aside>

    {{-- ========================================================= --}}
    {{-- MAP AREA                                                   --}}
    {{-- ========================================================= --}}
    <div class="flex-1 relative">
        <div id="map"></div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
// ----------------------------------------------------------------
// KOORDINAT: Kampung Tanjung Perangat, Sambaliung, Berau
// ----------------------------------------------------------------
const CENTER = [2.0820, 117.3630];

const map = L.map('map', {
    center: CENTER,
    zoom: 15,
    zoomControl: false,
});

// Basemap: OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    maxZoom: 19,
}).addTo(map);

// Zoom control custom position (top-right)
L.control.zoom({ position: 'topright' }).addTo(map);

// ----------------------------------------------------------------
// DATA TITIK LOKASI
// ----------------------------------------------------------------
const locations = [
    // Pemerintahan
    { id: 'pemerintahan', lat: 2.0820, lng: 117.3630, color: '#3b82f6', name: 'Kantor Desa',        address: 'Jl. Desa No. 1',          phone: '+62 812-3456-7890' },
    { id: 'pemerintahan', lat: 2.0840, lng: 117.3650, color: '#3b82f6', name: 'Balai Kampung',       address: 'Jl. Poros Desa No. 5',     phone: '+62 812-3456-7891' },
    { id: 'pemerintahan', lat: 2.0800, lng: 117.3610, color: '#3b82f6', name: 'Pos Siskamling',      address: 'RT 02, Jl. Keamanan',      phone: '-' },

    // Kesehatan
    { id: 'kesehatan', lat: 2.0835, lng: 117.3660, color: '#15803d', name: 'Puskesmas Pembantu',  address: 'Jl. Sehat No. 3',          phone: '+62 813-1122-3344' },
    { id: 'kesehatan', lat: 2.0795, lng: 117.3645, color: '#15803d', name: 'Posyandu Melati',     address: 'Jl. Mawar RT 01',          phone: '+62 813-1122-3345' },
    { id: 'kesehatan', lat: 2.0855, lng: 117.3620, color: '#15803d', name: 'Posyandu Dahlia',     address: 'Jl. Dahlia RT 03',         phone: '+62 813-1122-3346' },
    { id: 'kesehatan', lat: 2.0810, lng: 117.3670, color: '#15803d', name: 'Posyandu Anggrek',    address: 'Jl. Anggrek RT 04',        phone: '+62 813-1122-3347' },
    { id: 'kesehatan', lat: 2.0780, lng: 117.3625, color: '#15803d', name: 'Apotek Desa',         address: 'Jl. Kesehatan No. 7',      phone: '+62 813-1122-3348' },

    // Pendidikan
    { id: 'pendidikan', lat: 2.0845, lng: 117.3600, color: '#f59e0b', name: 'SDN Tanjung Perangat 1', address: 'Jl. Pendidikan No. 1',  phone: '+62 811-2233-4455' },
    { id: 'pendidikan', lat: 2.0810, lng: 117.3680, color: '#f59e0b', name: 'SDN Tanjung Perangat 2', address: 'Jl. Belajar No. 2',     phone: '+62 811-2233-4456' },
    { id: 'pendidikan', lat: 2.0790, lng: 117.3655, color: '#f59e0b', name: 'SDN Tanjung Perangat 3', address: 'Jl. Ilmu No. 3',        phone: '+62 811-2233-4457' },
    { id: 'pendidikan', lat: 2.0830, lng: 117.3640, color: '#f59e0b', name: 'TK Melati',          address: 'Jl. Ceria No. 1',          phone: '+62 811-2233-4458' },
    { id: 'pendidikan', lat: 2.0860, lng: 117.3660, color: '#f59e0b', name: 'PAUD Pelangi',       address: 'Jl. Anak No. 2',           phone: '+62 811-2233-4459' },
    { id: 'pendidikan', lat: 2.0770, lng: 117.3640, color: '#f59e0b', name: 'Perpustakaan Desa',  address: 'Jl. Buku No. 1',           phone: '-' },
    { id: 'pendidikan', lat: 2.0800, lng: 117.3590, color: '#f59e0b', name: 'Madrasah Diniyah',   address: 'Jl. Agama No. 5',          phone: '+62 811-2233-4460' },

    // Sarana Ibadah
    { id: 'ibadah', lat: 2.0825, lng: 117.3615, color: '#8b5cf6', name: 'Masjid Al-Ikhlas',     address: 'Jl. Masjid No. 1',         phone: '-' },
    { id: 'ibadah', lat: 2.0855, lng: 117.3645, color: '#8b5cf6', name: 'Masjid Al-Falah',      address: 'Jl. Masjid No. 2',         phone: '-' },
    { id: 'ibadah', lat: 2.0790, lng: 117.3600, color: '#8b5cf6', name: 'Mushola Ar-Rahman',    address: 'RT 01, Jl. Damai',         phone: '-' },
    { id: 'ibadah', lat: 2.0815, lng: 117.3660, color: '#8b5cf6', name: 'Mushola Al-Barokah',   address: 'RT 02, Jl. Sejahtera',     phone: '-' },
    { id: 'ibadah', lat: 2.0840, lng: 117.3580, color: '#8b5cf6', name: 'Langgar Miftahul Huda','address': 'RT 03, Jl. Pondok',      phone: '-' },
    { id: 'ibadah', lat: 2.0870, lng: 117.3635, color: '#8b5cf6', name: 'Mushola Al-Hidayah',   address: 'RT 04, Jl. Hidayah',       phone: '-' },
    { id: 'ibadah', lat: 2.0760, lng: 117.3650, color: '#8b5cf6', name: 'Masjid Nurul Huda',    address: 'Jl. Nurul No. 3',          phone: '-' },
    { id: 'ibadah', lat: 2.0808, lng: 117.3622, color: '#8b5cf6', name: 'Surau Darussalam',     address: 'RT 05, Jl. Pelajar',       phone: '-' },
    { id: 'ibadah', lat: 2.0835, lng: 117.3575, color: '#8b5cf6', name: 'Mushola Al-Amin',      address: 'RT 06, Jl. Aman',          phone: '-' },

    // Perbankan
    { id: 'perbankan', lat: 2.0822, lng: 117.3648, color: '#14b8a6', name: 'BRI Unit Sambaliung', address: 'Jl. Bank No. 1',          phone: '+62 821-3344-5566' },
    { id: 'perbankan', lat: 2.0802, lng: 117.3632, color: '#14b8a6', name: 'ATM BNI',             address: 'Jl. Raya Desa No. 5',     phone: '-' },
    { id: 'perbankan', lat: 2.0843, lng: 117.3618, color: '#14b8a6', name: 'Koperasi Desa',        address: 'Jl. Koperasi No. 2',      phone: '+62 821-3344-5567' },
    { id: 'perbankan', lat: 2.0785, lng: 117.3665, color: '#14b8a6', name: 'Agen BRI Link',        address: 'Toko Maju Bersama',       phone: '+62 821-3344-5568' },
];

// ----------------------------------------------------------------
// BUAT MARKER ICONS
// ----------------------------------------------------------------
function createIcon(color) {
    return L.divIcon({
        className: '',
        html: `<div style="
            width:22px; height:22px; border-radius:50%;
            background:${color}; border:2.5px solid white;
            box-shadow:0 2px 6px rgba(0,0,0,0.3);
            display:flex; align-items:center; justify-content:center;
        "></div>`,
        iconSize: [22, 22],
        iconAnchor: [11, 11],
        popupAnchor: [0, -14],
    });
}

// ----------------------------------------------------------------
// TAMBAHKAN MARKER KE PETA
// ----------------------------------------------------------------
const markerGroups = {};

locations.forEach(loc => {
    const marker = L.marker([loc.lat, loc.lng], { icon: createIcon(loc.color) })
        .bindPopup(`
            <div style="font-family:'Inter',sans-serif; min-width:160px;">
                <p style="font-weight:700; font-size:12px; color:#111827; margin:0 0 6px;">${loc.name}</p>
                <p style="font-size:10px; color:#6b7280; margin:0 0 2px;">📍 ${loc.address}</p>
                ${loc.phone !== '-' ? `<p style="font-size:10px; color:#6b7280; margin:0;">📞 ${loc.phone}</p>` : ''}
            </div>
        `, { maxWidth: 220 });

    if (!markerGroups[loc.id]) markerGroups[loc.id] = [];
    markerGroups[loc.id].push(marker);
    marker.addTo(map);
});

// Buka popup Kantor Desa secara default
markerGroups['pemerintahan'][0].openPopup();

// ----------------------------------------------------------------
// FILTER FUNCTION
// ----------------------------------------------------------------
let activeFilter = 'all';

function filterMarkers(categoryId) {
    activeFilter = categoryId;

    // Update semua marker
    Object.keys(markerGroups).forEach(key => {
        markerGroups[key].forEach(m => {
            if (categoryId === 'all' || key === categoryId) {
                m.addTo(map);
            } else {
                map.removeLayer(m);
            }
        });
    });

    // Update UI filter buttons
    document.querySelectorAll('.filter-item').forEach(btn => {
        btn.classList.remove('active');
    });
    const activeBtn = document.getElementById('filter-' + categoryId);
    if (activeBtn) activeBtn.classList.add('active');

    // Update label styling
    document.querySelectorAll('[id^="filter-label-"]').forEach(el => {
        el.classList.remove('text-green-700', 'font-bold');
        el.classList.add('text-gray-700', 'font-normal');
    });
    const activeLabel = document.getElementById('filter-label-' + categoryId);
    if (activeLabel) {
        activeLabel.classList.add('text-green-700', 'font-bold');
        activeLabel.classList.remove('text-gray-700', 'font-normal');
    }
}
</script>
@endpush
