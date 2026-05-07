@extends('layouts.app')

@section('title', 'Infografis')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Infografis</h1>
        <p class="text-gray-500 mt-1">Visualisasi data desa dalam bentuk gambar infografis</p>
    </div>

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 mb-6">
        <div class="flex flex-wrap gap-3 items-center">
            @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('infografis.index', request()->except('kategori')) }}"
                   class="px-4 py-1.5 rounded-full text-sm font-medium transition
                       {{ !request('kategori') ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('infografis.index', array_merge(request()->all(), ['kategori' => $cat])) }}"
                   class="px-4 py-1.5 rounded-full text-sm font-medium transition
                       {{ request('kategori') == $cat ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    {{ $cat }}
                </a>
                @endforeach
            </div>
            @endif

            @if($years->isNotEmpty())
            <select name="tahun" onchange="this.form.submit()"
                    class="border border-gray-200 rounded-xl px-4 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="">Semua Tahun</option>
                @foreach($years as $year)
                    <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
            @endif
        </div>
    </form>

    {{-- Grid --}}
    @if($items->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="font-medium text-lg">Infografis tidak ditemukan</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            @foreach($items as $item)
            <a href="{{ route('infografis.show', $item->slug) }}"
               class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all">
                <div class="aspect-square overflow-hidden bg-gray-100">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title }}"
                         loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-4">
                    <p class="font-semibold text-gray-800 text-sm leading-snug line-clamp-2 group-hover:text-green-700 transition">
                        {{ $item->title }}
                    </p>
                    <div class="flex items-center gap-2 mt-2">
                        @if($item->category)
                            <span class="text-xs bg-green-50 text-green-600 px-2 py-0.5 rounded-full">{{ $item->category }}</span>
                        @endif
                        @if($item->data_year)
                            <span class="text-xs text-gray-400">{{ $item->data_year }}</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $items->links() }}
        </div>
    @endif
</div>
@endsection
