@extends('layouts.app')

@section('title', $item->title)

@section('content')

{{-- ═══════════════════════════════════════════════
     PAGE HEADER
═══════════════════════════════════════════════ --}}
<div class="bg-gradient-to-br from-green-800 via-green-700 to-emerald-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <nav class="flex items-center gap-2 text-sm text-green-200 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a>
            <span>›</span>
            <a href="{{ route('infografis.index') }}" class="hover:text-white transition">Infografis</a>
            <span>›</span>
            <span class="text-white font-medium line-clamp-1">{{ $item->title }}</span>
        </nav>
        <h1 class="text-2xl lg:text-3xl font-bold max-w-3xl leading-tight">{{ $item->title }}</h1>
        <div class="flex flex-wrap items-center gap-4 mt-3 text-sm text-green-200">
            @if($item->data_year)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Data Tahun {{ $item->data_year }}
                </span>
            @endif
            @if($item->category ?? null)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    {{ $item->category }}
                </span>
            @endif
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Infografis Image (main) --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                @if($item->image_url ?? null)
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title }}"
                         class="w-full object-contain max-h-[600px] bg-gray-50">
                @else
                    <div class="w-full h-64 bg-gradient-to-br from-green-50 to-emerald-100
                                flex items-center justify-center">
                        <svg class="w-20 h-20 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif

                {{-- Caption / Deskripsi --}}
                @if($item->description)
                    <div class="p-6 border-t border-gray-50">
                        <p class="text-gray-600 leading-relaxed">{{ $item->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar: Detail & Related --}}
        <div class="space-y-6">

            {{-- Detail Metadata --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-800 mb-4">Detail Infografis</h2>
                <dl class="space-y-3 text-sm">
                    <div class="flex flex-col gap-0.5">
                        <dt class="text-gray-400 text-xs uppercase tracking-wider">Judul</dt>
                        <dd class="text-gray-800 font-medium">{{ $item->title }}</dd>
                    </div>
                    @if($item->data_year)
                        <div class="flex flex-col gap-0.5 pt-3 border-t border-gray-50">
                            <dt class="text-gray-400 text-xs uppercase tracking-wider">Tahun Data</dt>
                            <dd class="text-gray-800 font-medium">{{ $item->data_year }}</dd>
                        </div>
                    @endif
                    @if($item->source ?? null)
                        <div class="flex flex-col gap-0.5 pt-3 border-t border-gray-50">
                            <dt class="text-gray-400 text-xs uppercase tracking-wider">Sumber</dt>
                            <dd class="text-gray-800">{{ $item->source }}</dd>
                        </div>
                    @endif
                    @if($item->created_at)
                        <div class="flex flex-col gap-0.5 pt-3 border-t border-gray-50">
                            <dt class="text-gray-400 text-xs uppercase tracking-wider">Dipublikasikan</dt>
                            <dd class="text-gray-800">{{ $item->created_at->translatedFormat('d F Y') }}</dd>
                        </div>
                    @endif
                </dl>

                {{-- Download / Share --}}
                @if($item->image_url ?? null)
                    <div class="mt-5 pt-4 border-t border-gray-100">
                        <a href="{{ $item->image_url }}"
                           download="{{ Str::slug($item->title) }}"
                           target="_blank"
                           class="flex items-center justify-center gap-2 w-full
                                  bg-green-700 text-white text-sm font-semibold
                                  px-4 py-2.5 rounded-xl hover:bg-green-800 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Unduh Infografis
                        </a>
                    </div>
                @endif
            </div>

            {{-- Infografis Terkait --}}
            @if($related->isNotEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h2 class="font-semibold text-gray-800 mb-4">Infografis Lainnya</h2>
                <div class="space-y-3">
                    @foreach($related as $rel)
                    <a href="{{ route('infografis.show', $rel->slug) }}"
                       class="flex items-start gap-3 group hover:bg-gray-50 rounded-xl p-2 -mx-2 transition">
                        {{-- Thumbnail --}}
                        <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($rel->image_url ?? null)
                                <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-700 group-hover:text-green-700
                                      transition line-clamp-2 leading-snug">
                                {{ $rel->title }}
                            </p>
                            @if($rel->data_year)
                                <p class="text-xs text-gray-400 mt-1">{{ $rel->data_year }}</p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>

                <a href="{{ route('infografis.index') }}"
                   class="block text-center text-sm text-green-700 font-medium hover:underline mt-4 pt-3 border-t border-gray-50">
                    Lihat semua infografis →
                </a>
            </div>
            @endif

        </div>{{-- /sidebar --}}
    </div>
</div>

@endsection
