@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'Statistik')

@section('content')

{{-- ═══════════════════════════════════════════════
     PAGE HEADER
═══════════════════════════════════════════════ --}}
<div class="bg-gradient-to-br from-green-800 via-green-700 to-emerald-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        <nav class="flex items-center gap-2 text-sm text-green-200 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>›</span>
            @if(isset($category))
                <a href="{{ route('statistik.index') }}" class="hover:text-white transition">Statistik</a>
                <span>›</span>
                <span class="text-white font-medium">{{ $category->name }}</span>
            @else
                <span class="text-white font-medium">Statistik</span>
            @endif
        </nav>
        <h1 class="text-3xl lg:text-4xl font-bold">
            {{ isset($category) ? $category->name : 'Data Statistik' }}
        </h1>
        <p class="text-green-100 mt-2 max-w-2xl">
            @if(isset($category))
                {{ $category->description ?? 'Data statistik kategori ' . $category->name }}
            @else
                Jelajahi seluruh data statistik desa, mulai dari kependudukan, sarana, hingga ekonomi.
            @endif
        </p>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @if(isset($category))
        {{-- ───────────────────────────────────────────
             MODE: daftar statistik dalam satu kategori
        ─────────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            {{-- Sidebar Kategori --}}
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 sticky top-20">
                    <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-3">Semua Kategori</p>
                    <ul class="space-y-1">
                        @foreach($allCategories as $cat)
                        <li>
                            <a href="{{ route('statistik.category', $cat->slug) }}"
                               class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition
                                   {{ $cat->id === $category->id
                                       ? 'bg-green-50 text-green-700 font-medium'
                                       : 'text-gray-600 hover:bg-gray-50' }}">
                                @if($cat->icon)
                                    <span>{{ $cat->icon }}</span>
                                @endif
                                {{ $cat->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Daftar Statistik --}}
            <div class="lg:col-span-3">
                @if($statistics->isEmpty())
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                        <p class="text-gray-400 text-lg">Belum ada data statistik untuk kategori ini.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($statistics as $stat)
                        <a href="{{ route('statistik.show', [$category->slug, $stat->slug]) }}"
                           class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-5
                                  hover:shadow-md hover:border-green-200 transition-all">

                            {{-- Label kategori --}}
                            <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full mb-3">
                                {{ $category->name }}
                            </span>

                            <h3 class="font-semibold text-gray-800 group-hover:text-green-700 transition mb-2 leading-snug">
                                {{ $stat->title }}
                            </h3>

                            @if($stat->summary_value)
                                <p class="text-2xl font-black text-green-700">
                                    {{ $stat->summary_value }}
                                    @if($stat->unit)
                                        <span class="text-sm font-normal text-gray-400 ml-1">{{ $stat->unit }}</span>
                                    @endif
                                </p>
                                @if($stat->summary_label)
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $stat->summary_label }}</p>
                                @endif
                            @endif

                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50">
                                @if($stat->data_year)
                                    <span class="text-xs text-gray-400">Data {{ $stat->data_year }}</span>
                                @else
                                    <span></span>
                                @endif
                                <span class="text-xs text-green-600 font-medium group-hover:underline">
                                    Lihat detail →
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    @else
        {{-- ───────────────────────────────────────────
             MODE: semua kategori (halaman index utama)
        ─────────────────────────────────────────────── --}}
        @if($categories->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center">
                <p class="text-gray-400 text-lg">Belum ada kategori statistik.</p>
            </div>
        @else
            <div class="space-y-10">
                @foreach($categories as $cat)
                <section>
                    {{-- Header Kategori --}}
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            @if($cat->icon)
                                <span class="text-2xl">{{ $cat->icon }}</span>
                            @else
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $cat->name }}</h2>
                                @if($cat->description)
                                    <p class="text-sm text-gray-500">{{ $cat->description }}</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('statistik.category', $cat->slug) }}"
                           class="text-sm text-green-700 font-medium hover:underline hidden sm:block">
                            Lihat semua →
                        </a>
                    </div>

                    {{-- Grid Statistik dalam kategori ini --}}
                    @if($cat->statistics->isEmpty())
                        <p class="text-gray-400 text-sm italic">Belum ada data.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                            @foreach($cat->statistics->take(5) as $stat)
                            <a href="{{ route('statistik.show', [$cat->slug, $stat->slug]) }}"
                               class="group bg-white rounded-xl border border-gray-100 shadow-sm p-4
                                      hover:shadow-md hover:border-green-200 transition-all text-center">

                                @if($stat->summary_value)
                                    <p class="text-2xl font-black text-green-700 leading-tight">
                                        {{ $stat->summary_value }}
                                    </p>
                                    @if($stat->unit)
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $stat->unit }}</p>
                                    @endif
                                @endif
                                <p class="text-xs font-medium text-gray-600 mt-2 leading-snug group-hover:text-green-700 transition">
                                    {{ $stat->summary_label ?? $stat->title }}
                                </p>
                                @if($stat->data_year)
                                    <p class="text-xs text-gray-300 mt-1">{{ $stat->data_year }}</p>
                                @endif
                            </a>
                            @endforeach

                            {{-- "Lihat semua" card jika lebih dari 5 --}}
                            @if($cat->statistics->count() > 5)
                            <a href="{{ route('statistik.category', $cat->slug) }}"
                               class="bg-green-50 rounded-xl border-2 border-dashed border-green-200 p-4
                                      flex flex-col items-center justify-center text-center
                                      hover:bg-green-100 hover:border-green-300 transition-all">
                                <span class="text-2xl font-black text-green-600">+{{ $cat->statistics->count() - 5 }}</span>
                                <span class="text-xs text-green-600 font-medium mt-1">data lainnya</span>
                            </a>
                            @endif
                        </div>
                    @endif

                    <a href="{{ route('statistik.category', $cat->slug) }}"
                       class="text-sm text-green-700 font-medium hover:underline sm:hidden mt-2 inline-block">
                        Lihat semua →
                    </a>
                </section>
                @endforeach
            </div>
        @endif
    @endif

</div>

@endsection
