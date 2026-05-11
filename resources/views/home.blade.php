@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- ═══════════════════════════════════════════════
     HERO
═══════════════════════════════════════════════ --}}
<section class="relative bg-gradient-to-br from-green-800 via-green-700 to-emerald-600 text-white overflow-hidden">
    {{-- Background pattern --}}
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="max-w-3xl">
            <span class="inline-block bg-white/20 backdrop-blur-sm text-white text-sm font-medium px-4 py-1.5 rounded-full mb-4">
                📊 Portal Data Terbuka
            </span>
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-4">
                Data & Informasi<br>
                <span class="text-emerald-200">{{ \App\Models\Setting::get('site_name', 'Desa Kami') }}</span>
            </h1>
            <p class="text-lg text-green-100 mb-8 leading-relaxed max-w-2xl">
                {{ \App\Models\Setting::get('hero_description', 'Portal resmi data statistik, peta wilayah, infografis, dan publikasi dokumen desa untuk masyarakat.') }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('statistik.index') }}"
                   class="bg-white text-green-800 font-semibold px-6 py-3 rounded-xl hover:bg-green-50 transition shadow-lg">
                    Lihat Statistik
                </a>
                <a href="{{ route('publikasi.index') }}"
                   class="border-2 border-white text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition">
                    Unduh Publikasi
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     KPI STATS CARDS
═══════════════════════════════════════════════ --}}
@if($kpiStats->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10 mb-12">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-{{ min($kpiStats->count(), 6) }} gap-4">
        @foreach($kpiStats as $stat)
        <div class="bg-white rounded-2xl shadow-md p-5 border border-gray-100 hover:shadow-lg transition">
            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">{{ $stat->summary_label ?? $stat->title }}</p>
            <p class="text-3xl font-bold text-green-700">{{ $stat->summary_value }}</p>
            @if($stat->unit)
                <p class="text-xs text-gray-400 mt-1">{{ $stat->unit }}</p>
            @endif
            @if($stat->data_year)
                <p class="text-xs text-gray-400">Data {{ $stat->data_year }}</p>
            @endif
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════
     SECTION CARDS (Statistik, Spasial, Infografis, Publikasi)
═══════════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="text-center mb-10">
        <h2 class="text-2xl font-bold text-gray-800">Jelajahi Data</h2>
        <p class="text-gray-500 mt-2">Temukan informasi lengkap tentang {{ \App\Models\Setting::get('site_name', 'desa kami') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Statistik --}}
        <a href="{{ route('statistik.index') }}"
           class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-200 transition">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 mb-1 group-hover:text-green-700">Statistik</h3>
            <p class="text-sm text-gray-500">Data kependudukan, sarana, dan statistik desa</p>
        </a>

        {{-- Spasial --}}
        <a href="{{ route('spasial.index') }}"
           class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-green-200 transition">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 mb-1 group-hover:text-green-700">Spasial / Peta</h3>
            <p class="text-sm text-gray-500">Peta interaktif fasilitas dan wilayah desa</p>
        </a>

        {{-- Infografis --}}
        <a href="{{ route('infografis.index') }}"
           class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-purple-200 transition">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 mb-1 group-hover:text-green-700">Infografis</h3>
            <p class="text-sm text-gray-500">Visualisasi data dalam bentuk infografis menarik</p>
        </a>

        {{-- Publikasi --}}
        <a href="{{ route('publikasi.index') }}"
           class="group bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mb-4 group-hover:bg-orange-200 transition">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-800 mb-1 group-hover:text-green-700">Publikasi</h3>
            <p class="text-sm text-gray-500">Dokumen, laporan, dan monografi desa</p>
        </a>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     LATEST INFOGRAFIS
═══════════════════════════════════════════════ --}}
@if($latestInfografis->isNotEmpty())
<section class="bg-gray-100 py-12 mt-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-800">Infografis Terbaru</h2>
            <a href="{{ route('infografis.index') }}" class="text-sm text-green-700 font-medium hover:underline">
                Lihat semua →
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($latestInfografis as $item)
            <a href="{{ route('infografis.show', $item->slug) }}"
               class="group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition">
                <div class="aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-3">
                    <p class="text-sm font-medium text-gray-800 line-clamp-2">{{ $item->title }}</p>
                    @if($item->data_year)
                        <p class="text-xs text-gray-400 mt-1">{{ $item->data_year }}</p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════
     LATEST PUBLICATIONS
═══════════════════════════════════════════════ --}}
@if($latestPublications->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Publikasi Terbaru</h2>
        <a href="{{ route('publikasi.index') }}" class="text-sm text-green-700 font-medium hover:underline">
            Lihat semua →
        </a>
    </div>
    <div class="space-y-3">
        @foreach($latestPublications as $pub)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center gap-4 hover:border-green-200 transition">
            <div class="w-10 h-12 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-gray-800 truncate">{{ $pub->title }}</p>
                <p class="text-xs text-gray-400">
                    {{ $pub->category }} • {{ $pub->published_date?->format('d M Y') }}
                    • {{ $pub->file_size_human }}
                </p>
            </div>
            <a href="{{ route('publikasi.download', $pub->slug) }}"
               class="flex-shrink-0 bg-green-50 text-green-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-green-100 transition">
                Unduh
            </a>
        </div>
        @endforeach
    </div>
</section>
@endif

@endsection
