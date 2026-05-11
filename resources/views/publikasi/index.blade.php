@extends('layouts.app')

@section('title', 'Publikasi & Dokumen')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Publikasi & Dokumen</h1>
        <p class="text-gray-500 mt-1">Laporan, monografi, peraturan, dan dokumen resmi desa</p>
    </div>

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <input type="text" name="cari" value="{{ request('cari') }}"
                   placeholder="🔍  Cari judul dokumen..."
                   class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">

            <select name="kategori" class="border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('kategori') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <select name="tahun" class="flex-1 border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                    <option value="">Semua Tahun</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-green-700 transition">
                    Cari
                </button>
                @if(request()->hasAny(['cari','kategori','tahun']))
                    <a href="{{ route('publikasi.index') }}" class="border border-gray-200 text-gray-500 px-4 py-2 rounded-xl text-sm hover:bg-gray-50 transition">
                        Reset
                    </a>
                @endif
            </div>
        </div>
    </form>

    {{-- Results --}}
    @if($publications->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-lg font-medium">Dokumen tidak ditemukan</p>
        </div>
    @else
        <div class="space-y-3">
            @foreach($publications as $pub)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:border-green-200 hover:shadow-md transition p-5">
                <div class="flex items-start gap-4">
                    {{-- PDF Icon --}}
                    <div class="w-12 h-14 bg-red-50 border border-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/>
                        </svg>
                        <span class="absolute text-xs font-bold text-red-600 mt-5">PDF</span>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-800 text-base leading-snug">{{ $pub->title }}</h3>
                        @if($pub->description)
                            <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $pub->description }}</p>
                        @endif
                        <div class="flex flex-wrap gap-3 mt-2">
                            @if($pub->category)
                                <span class="text-xs bg-blue-50 text-blue-600 px-2.5 py-0.5 rounded-full font-medium">
                                    {{ $pub->category }}
                                </span>
                            @endif
                            @if($pub->data_year)
                                <span class="text-xs text-gray-400">📅 {{ $pub->data_year }}</span>
                            @endif
                            @if($pub->author)
                                <span class="text-xs text-gray-400">✍️ {{ $pub->author }}</span>
                            @endif
                            <span class="text-xs text-gray-400">📦 {{ $pub->file_size_human }}</span>
                            <span class="text-xs text-gray-400">⬇ {{ $pub->download_count }} unduhan</span>
                        </div>
                    </div>

                    {{-- Download button --}}
                    <a href="{{ route('publikasi.download', $pub->slug) }}"
                       class="flex-shrink-0 flex items-center gap-2 bg-green-600 text-white text-sm font-medium px-4 py-2.5 rounded-xl hover:bg-green-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Unduh
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $publications->links() }}
        </div>
    @endif
</div>
@endsection
