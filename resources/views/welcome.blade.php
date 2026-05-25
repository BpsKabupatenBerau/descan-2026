@extends('layouts.app')

@section('title', 'Beranda - Desa Cantik | Data & Informasi Kampung Tanjung Perangat')

@section('content')

{{-- ============================================================ --}}
{{-- HERO SECTION                                                  --}}
{{-- ============================================================ --}}
<section class="w-full bg-green-900 relative overflow-hidden" style="padding-bottom: 80px; min-height: 300px;">
    {{-- Grid overlay --}}
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(to right, rgba(255,255,255,0.4) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.4) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="absolute inset-0 bg-green-950 opacity-30"></div>

    {{-- Bar chart decoration --}}
    <div class="absolute right-32 bottom-16 flex items-end gap-3 pointer-events-none select-none">
        <div class="w-12 h-20 bg-blue-400 rounded-t-sm opacity-80"></div>
        <div class="w-12 h-36 bg-emerald-400 rounded-t-sm opacity-80"></div>
        <div class="w-12 h-16 bg-amber-400 rounded-t-sm opacity-80"></div>
        <div class="w-12 h-28 bg-red-400 rounded-t-sm opacity-80"></div>
        <div class="w-12 h-24 bg-violet-400 rounded-t-sm opacity-80"></div>
    </div>

    <div class="relative z-10 max-w-5xl px-16 pt-14 pb-4">
        <h1 class="text-white text-5xl font-bold leading-tight">Data &amp; Informasi</h1>
        <h2 class="text-green-300 text-5xl font-bold leading-tight mt-1">Kampung Tanjung Perangat</h2>
        <p class="text-green-200 text-sm mt-4 leading-relaxed max-w-md">
            Portal resmi data statistik, peta wilayah, infografis,<br>
            dan publikasi dokumen untuk masyarakat kampung.
        </p>
        <div class="flex items-center gap-3 mt-7">
            <a href="{{ url('/statistik') }}" id="hero-statistik" class="px-6 py-2.5 bg-white text-green-900 text-xs font-bold rounded hover:bg-green-50 transition-colors shadow">
                Lihat Statistik
            </a>
            <a href="#" id="hero-publikasi" class="px-6 py-2.5 border border-white border-opacity-60 text-white text-xs font-bold rounded hover:bg-white hover:bg-opacity-10 transition-colors">
                Unduh Publikasi
            </a>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- STATISTICS CARDS — FLOATING OVERLAP                          --}}
{{-- ============================================================ --}}
<section class="relative z-20 px-8 -mt-10">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="grid grid-cols-6 divide-x divide-gray-100">
            @php
            $stats = [
                ['color' => '#3b82f6', 'label' => 'Total Penduduk',  'value' => '4.872', 'unit' => 'Jiwa'],
                ['color' => '#15803d', 'label' => 'Kepala Keluarga', 'value' => '1.423', 'unit' => 'KK'],
                ['color' => '#f59e0b', 'label' => 'Melek Huruf',     'value' => '94,3%', 'unit' => 'Persen'],
                ['color' => '#ef4444', 'label' => 'Posyandu',        'value' => '12',    'unit' => 'Unit'],
                ['color' => '#8b5cf6', 'label' => 'SD/MI',           'value' => '3',     'unit' => 'Sekolah'],
                ['color' => '#14b8a6', 'label' => 'Laki-laki',       'value' => '2.480', 'unit' => 'Jiwa'],
            ];
            @endphp

            @foreach($stats as $stat)
            <div class="px-5 py-4 hover:bg-gray-50 transition-colors">
                <p class="text-gray-400 text-[10px] font-medium uppercase tracking-wide mb-1">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold leading-none" style="color: {{ $stat['color'] }}">{{ $stat['value'] }}</p>
                <p class="text-gray-400 text-[10px] mt-1.5">{{ $stat['unit'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- JELAJAHI DATA SECTION                                         --}}
{{-- ============================================================ --}}
<section class="px-8 pt-8 pb-10 bg-stone-50">
    <h2 class="text-gray-900 text-lg font-bold">Jelajahi Data</h2>
    <p class="text-gray-400 text-xs mt-0.5 mb-5">Temukan informasi lengkap tentang Kampung Tanjung Perangat</p>

    <div class="grid grid-cols-4 gap-4">
        @php
        $menus = [
            ['bg' => '#eff6ff', 'icon_color' => '#3b82f6', 'title' => 'Statistik',       'desc' => 'Data kependudukan, sarana, dan statistik desa',       'href' => '/statistik',
             'icon' => '<path d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z"/>'],
            ['bg' => '#f0fdf4', 'icon_color' => '#15803d', 'title' => 'Spasial / Peta',  'desc' => 'Peta interaktif fasilitas dan wilayah desa',             'href' => '/spasial',
             'icon' => '<path d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/>'],
            ['bg' => '#faf5ff', 'icon_color' => '#8b5cf6', 'title' => 'Infografis',      'desc' => 'Visualisasi data dalam bentuk infografis menarik',       'href' => '/infografis',
             'icon' => '<path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2.03 0v8.99H22c-.47-4.74-4.24-8.52-8.97-8.99zm0 11.01V22c4.74-.47 8.5-4.25 8.97-8.99h-8.97z"/>'],
            ['bg' => '#fff7ed', 'icon_color' => '#f97316', 'title' => 'Publikasi',       'desc' => 'Dokumen, laporan, dan monografi desa',                   'href' => '/publikasi',
             'icon' => '<path d="M20 2H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 5h-3v5.5c0 1.38-1.12 2.5-2.5 2.5S10 13.88 10 12.5s1.12-2.5 2.5-2.5c.57 0 1.08.19 1.5.51V5h4v2zM4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6z"/>'],
        ];
        @endphp

        @foreach($menus as $menu)
        <a href="{{ url($menu['href']) }}" class="bg-white border border-gray-200 rounded-lg p-5 flex items-start gap-4 hover:shadow-md hover:border-gray-300 transition-all group">
            <div class="w-11 h-11 rounded-lg flex items-center justify-center flex-shrink-0" style="background: {{ $menu['bg'] }}">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="{{ $menu['icon_color'] }}">{!! $menu['icon'] !!}</svg>
            </div>
            <div>
                <h3 class="text-gray-900 text-sm font-bold">{{ $menu['title'] }}</h3>
                <p class="text-gray-400 text-xs mt-1 leading-relaxed">{{ $menu['desc'] }}</p>
            </div>
        </a>
        @endforeach
    </div>
</section>

{{-- ============================================================ --}}
{{-- INFOGRAFIS TERBARU                                            --}}
{{-- ============================================================ --}}
<section class="px-8 py-8 bg-gray-50 border-t border-gray-100">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-gray-900 text-base font-bold">Infografis Terbaru</h2>
        <a href="{{ url('/infografis') }}" class="text-green-700 text-xs font-medium hover:underline">Lihat semua →</a>
    </div>

    <div class="grid grid-cols-4 gap-4">
        @php
        $infografis = [
            ['color' => '#3b82f6', 'emoji' => '🖼', 'title' => 'Piramida Penduduk 2024', 'year' => '2024'],
            ['color' => '#15803d', 'emoji' => '🖼', 'title' => 'Peta Kemiskinan',         'year' => '2024'],
            ['color' => '#f59e0b', 'emoji' => '🖼', 'title' => 'Infrastruktur Desa',      'year' => '2024'],
            ['color' => '#8b5cf6', 'emoji' => '🖼', 'title' => 'Kesehatan Anak',          'year' => '2024'],
        ];
        @endphp

        @foreach($infografis as $item)
        <a href="#" class="bg-white rounded-lg overflow-hidden flex border border-gray-100 hover:shadow-md hover:border-gray-200 transition-all group">
            <div class="w-20 h-20 flex items-center justify-center flex-shrink-0 rounded-lg m-2" style="background: {{ $item['color'] }}">
                <span class="text-2xl">{{ $item['emoji'] }}</span>
            </div>
            <div class="flex flex-col justify-center px-3">
                <p class="text-gray-800 text-xs font-medium group-hover:text-green-700 transition-colors leading-snug">{{ $item['title'] }}</p>
                <p class="text-gray-400 text-[10px] mt-1.5">{{ $item['year'] }}</p>
            </div>
        </a>
        @endforeach
    </div>
</section>

@endsection
