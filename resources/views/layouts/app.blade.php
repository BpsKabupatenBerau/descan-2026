<!DOCTYPE html>
@use('App\Models\Setting')
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? Setting::get('site_description', 'Portal Data Desa') }}">
    <title>@yield('title', Setting::get('site_name', 'Portal Desa')) –
        {{ \App\Models\Setting::get('site_name', 'Portal Desa') }}</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Leaflet CSS (for spasial) --}}
    @stack('head-css')

    {{-- Vite compiled assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-inter antialiased bg-gray-50 text-gray-800">

    {{-- ═══════════════════════════════════════════════
    TOP BAR
    ═══════════════════════════════════════════════ --}}
    <div class="bg-green-800 text-white text-xs py-1 px-4 text-center">
        {{ Setting::get('top_bar_text', 'Selamat datang di Portal Data ' . Setting::get('site_name', 'Desa')) }}
    </div>

    {{-- ═══════════════════════════════════════════════
    NAVBAR
    ═══════════════════════════════════════════════ --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
            <div class="flex items-center justify-between h-16">

                {{-- Logo & Site Name --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if(Setting::get('site_logo'))
                        <img src="{{ asset('storage/' . Setting::get('site_logo')) }}" alt="Logo"
                            class="h-10 w-10 object-contain">
                    @else
                        <div
                            class="h-10 w-10 bg-green-700 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(Setting::get('site_name', 'D'), 0, 1)) }}
                        </div>
                    @endif
                    <div class="hidden sm:block">
                        <p class="font-semibold text-gray-900 leading-tight">
                            {{ Setting::get('site_name', 'Portal Desa') }}</p>
                        <p class="text-xs text-gray-500">{{ Setting::get('site_tagline', 'Data & Informasi Desa') }}</p>
                    </div>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Beranda
                    </a>

                    {{-- Statistik Dropdown --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="flex items-center gap-1 px-3 py-2 rounded-md text-sm font-medium
                            {{ request()->routeIs('statistik.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                            Statistik
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" x-transition
                            class="absolute left-0 mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                            <a href="{{ route('statistik.index') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                Semua Statistik
                            </a>
                            <hr class="my-1">
                            @foreach(\App\Models\KategoriStatistik::active()->orderBy('id')->get() as $cat)
                                <a href="{{ route('statistik.category', $cat->slug) }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">
                                    {{ $cat->judul_kategori }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('spasial.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('spasial.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Spasial
                    </a>

                    <a href="{{ route('infografis.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('infografis.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Infografis
                    </a>

                    <a href="{{ route('publikasi.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('publikasi.*') ? 'bg-green-50 text-green-700' : 'text-gray-600 hover:bg-gray-100' }}">
                        Publikasi
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <button @click="open = !open" class="md:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="open" x-transition class="md:hidden pb-3 space-y-1">
                <a href="{{ route('home') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Beranda</a>
                <a href="{{ route('statistik.index') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Statistik</a>
                <a href="{{ route('spasial.index') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Spasial</a>
                <a href="{{ route('infografis.index') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Infografis</a>
                <a href="{{ route('publikasi.index') }}"
                    class="block px-3 py-2 rounded-md text-sm text-gray-700 hover:bg-gray-100">Publikasi</a>
            </div>
        </nav>
    </header>

    {{-- ═══════════════════════════════════════════════
    MAIN CONTENT
    ═══════════════════════════════════════════════ --}}
    <main>
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════════════
    FOOTER
    ═══════════════════════════════════════════════ --}}
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div>
                    <h3 class="text-white font-semibold text-lg mb-3">{{ Setting::get('site_name', 'Portal Desa') }}
                    </h3>
                    <p class="text-sm leading-relaxed">
                        {{ Setting::get('site_description', 'Portal data dan informasi desa yang menyajikan statistik, peta, infografis, dan publikasi.') }}
                    </p>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-3">Navigasi</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('statistik.index') }}" class="hover:text-white transition">Statistik</a>
                        </li>
                        <li><a href="{{ route('spasial.index') }}" class="hover:text-white transition">Spasial /
                                Peta</a></li>
                        <li><a href="{{ route('infografis.index') }}" class="hover:text-white transition">Infografis</a>
                        </li>
                        <li><a href="{{ route('publikasi.index') }}" class="hover:text-white transition">Publikasi</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-3">Kontak</h3>
                    <ul class="space-y-2 text-sm">
                        @if(Setting::get('contact_address'))
                            <li class="flex gap-2">
                                <span>📍</span> {{ Setting::get('contact_address') }}
                            </li>
                        @endif
                        @if(Setting::get('contact_phone'))
                            <li class="flex gap-2">
                                <span>📞</span> {{ Setting::get('contact_phone') }}
                            </li>
                        @endif
                        @if(Setting::get('contact_email'))
                            <li class="flex gap-2">
                                <span>✉️</span>
                                <a href="mailto:{{ Setting::get('contact_email') }}" class="hover:text-white">
                                    {{ Setting::get('contact_email') }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div
                class="border-t border-gray-700 mt-8 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-500">
                <p>© {{ date('Y') }} {{ Setting::get('site_name', 'Portal Desa') }}. Hak cipta dilindungi.</p>
                <p class="mt-2 sm:mt-0">Dibangun dengan Laravel & Filament</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>

</html>