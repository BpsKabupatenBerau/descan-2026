<x-filament-panels::page>
    @php
        $kategoriSpasial = \App\Models\KategoriSpasial::withCount('spasial')->get();
    @endphp

    <div class="descan-page">
        <div style="display: flex; justify-content: flex-end; margin-top: -64px; margin-bottom: 40px;">
            <a class="descan-primary-button" href="{{ \App\Filament\Resources\KategoriSpasialResource::getUrl('create') }}">+ Tambah Kategori</a>
        </div>

        <section style="max-width: 960px;">
            <div class="descan-panel-header descan-panel" style="border-color: rgba(22, 132, 61, .65);">
                <span>Kategori Spasial</span>
                <span class="descan-count" style="color: #16a34a;">{{ $kategoriSpasial->count() }}</span>
            </div>

            <div class="descan-list" style="margin-top: 10px;">
                @foreach ($kategoriSpasial as $index => $kategori)
                    <div class="descan-card-row descan-card-row-wide">
                        <span class="descan-icon-dot" style="background: {{ $kategori->warna_marker ? $kategori->warna_marker . '33' : ['rgba(37,99,235,.22)', 'rgba(16,185,129,.18)', 'rgba(245,158,11,.18)', 'rgba(139,92,246,.18)', 'rgba(20,184,166,.18)'][$index % 5] }}"></span>
                        <span>
                            <span class="descan-title">{{ $kategori->judul_kategori }}</span>
                            <span class="descan-subtitle">{{ $kategori->spasial_count }} lokasi</span>
                        </span>
                        <span class="descan-badge">{{ $kategori->is_active ? 'Aktif' : 'Draft' }}</span>
                        <span class="descan-actions">
                            <a class="descan-action descan-action-edit" href="{{ \App\Filament\Resources\KategoriSpasialResource::getUrl('edit', ['record' => $kategori]) }}" aria-label="Edit {{ $kategori->judul_kategori }}"></a>
                            <span class="descan-action descan-action-delete" aria-hidden="true"></span>
                        </span>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-filament-panels::page>
