@extends('layouts.app')

@section('title', 'Peta Spasial')

@push('head-css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Peta Spasial</h1>
        <p class="text-gray-500 mt-1">Peta interaktif fasilitas dan sarana di wilayah desa</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        {{-- Sidebar: category filters --}}
        <div class="lg:col-span-1 order-2 lg:order-1">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-3">Filter Kategori</p>
                <ul class="space-y-2" id="category-filters">
                    <li>
                        <button data-category="all"
                                class="filter-btn w-full text-left flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium bg-green-50 text-green-700"
                                onclick="filterCategory('all')">
                            <span class="w-3 h-3 rounded-full bg-gray-400 inline-block"></span>
                            Semua Lokasi
                            <span class="ml-auto text-xs text-gray-400">{{ collect($geoJson['features'])->count() }}</span>
                        </button>
                    </li>
                    @foreach($categories as $cat)
                    <li>
                        <button data-category="{{ $cat->id }}"
                                class="filter-btn w-full text-left flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition"
                                onclick="filterCategory({{ $cat->id }})">
                            <span class="w-3 h-3 rounded-full inline-block"
                                  style="background-color: {{ $cat->color }}"></span>
                            {{ $cat->name }}
                            <span class="ml-auto text-xs text-gray-400">{{ $cat->spatials_count }}</span>
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Map --}}
        <div class="lg:col-span-3 order-1 lg:order-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div id="map" class="w-full" style="height: 560px;"></div>
            </div>

            {{-- Popup info placeholder --}}
            <div id="location-info" class="hidden mt-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 id="info-name" class="font-semibold text-gray-800 text-lg"></h3>
                <p id="info-category" class="text-xs text-green-600 font-medium mb-2"></p>
                <p id="info-address" class="text-sm text-gray-500"></p>
                <p id="info-phone" class="text-sm text-gray-500"></p>
                <p id="info-description" class="text-sm text-gray-600 mt-2"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const geoJson = @json($geoJson);

// Default center: use first point or Balikpapan as fallback
const firstPoint = geoJson.features[0]?.geometry.coordinates;
const center = firstPoint ? [firstPoint[1], firstPoint[0]] : [-1.2379, 116.8529];

const map = L.map('map').setView(center, 14);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://openstreetmap.org">OpenStreetMap</a>'
}).addTo(map);

// Store all markers for filtering
let allMarkers = [];

function makeIcon(color) {
    return L.divIcon({
        className: '',
        html: `<div style="width:14px;height:14px;background:${color};border-radius:50%;border:2px solid white;box-shadow:0 1px 4px rgba(0,0,0,.4)"></div>`,
        iconSize: [14, 14],
        iconAnchor: [7, 7],
    });
}

geoJson.features.forEach(feature => {
    const p = feature.properties;
    const [lng, lat] = feature.geometry.coordinates;
    const color = p.color || '#3B82F6';

    const marker = L.marker([lat, lng], { icon: makeIcon(color) })
        .addTo(map)
        .bindPopup(`
            <div style="min-width:180px">
                <p style="font-weight:600;font-size:14px;margin-bottom:4px">${p.name}</p>
                <span style="font-size:11px;background:${color}22;color:${color};padding:2px 8px;border-radius:99px;">${p.category ?? ''}</span>
                ${p.address ? `<p style="font-size:12px;color:#6B7280;margin-top:6px">📍 ${p.address}</p>` : ''}
                ${p.phone ? `<p style="font-size:12px;color:#6B7280">📞 ${p.phone}</p>` : ''}
                ${p.description ? `<p style="font-size:12px;color:#374151;margin-top:4px">${p.description}</p>` : ''}
            </div>
        `);

    marker._categoryId = p.id;
    marker._feature = p;
    allMarkers.push({ marker, categoryName: p.category, color });
});

// Fit to bounds if points exist
if (geoJson.features.length > 0) {
    const group = L.featureGroup(allMarkers.map(m => m.marker));
    map.fitBounds(group.getBounds().pad(0.2));
}

window.filterCategory = function(categoryId) {
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('bg-green-50', 'text-green-700', 'font-medium');
        btn.classList.add('text-gray-600');
    });
    const activeBtn = document.querySelector(`[data-category="${categoryId}"]`);
    if (activeBtn) {
        activeBtn.classList.add('bg-green-50', 'text-green-700', 'font-medium');
        activeBtn.classList.remove('text-gray-600');
    }

    allMarkers.forEach(({ marker }) => {
        const p = marker._feature;
        const inCategory = categoryId === 'all' || p.category_id == categoryId;
        if (inCategory) {
            if (!map.hasLayer(marker)) map.addLayer(marker);
        } else {
            if (map.hasLayer(marker)) map.removeLayer(marker);
        }
    });
};
</script>
@endpush
