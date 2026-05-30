<x-filament-panels::page>
    @php
        $kategoriStatistik = \App\Models\KategoriStatistik::withCount('tabelStatistik')->get();
        $satuanStatistik = \App\Models\SatuanStatistik::withCount('tabelStatistik')->get();
        $tabelStatistik = \App\Models\TabelStatistik::with('kategori')->limit(3)->get();
    @endphp

    <div class="descan-page">
        <div class="descan-grid">
            <section>
                <div class="descan-panel-header descan-panel">
                    <span>Kategori Statistik</span>
                    <span class="descan-count">{{ $kategoriStatistik->count() }}</span>
                    <a class="descan-add descan-add-square" href="{{ \App\Filament\Resources\KategoriStatistikResource::getUrl('create') }}">+</a>
                </div>

                <div class="descan-list" style="margin-top: 8px;">
                    @foreach ($kategoriStatistik as $index => $kategori)
                        <div class="descan-card-row">
                            <span class="descan-icon-dot" style="background: {{ ['rgba(37,99,235,.22)', 'rgba(16,185,129,.18)', 'rgba(245,158,11,.18)', 'rgba(20,184,166,.18)'][$index % 4] }}"></span>
                            <span>
                                <span class="descan-title">{{ $kategori->judul_kategori }}</span>
                                <span class="descan-subtitle">{{ $kategori->tabel_statistik_count }} data</span>
                            </span>
                            <span class="descan-badge">{{ $kategori->is_active ? 'Aktif' : 'Draft' }}</span>
                            <span class="descan-actions">
                                <a class="descan-action descan-action-edit" href="{{ \App\Filament\Resources\KategoriStatistikResource::getUrl('edit', ['record' => $kategori]) }}" aria-label="Edit {{ $kategori->judul_kategori }}"></a>
                                <span class="descan-action descan-action-delete" aria-hidden="true"></span>
                            </span>
                        </div>
                    @endforeach
                </div>
            </section>

            <section>
                <div class="descan-panel-header descan-panel">
                    <span>Satuan Statistik</span>
                    <span class="descan-count">{{ $satuanStatistik->count() }}</span>
                    <span class="descan-add descan-add-square">+</span>
                </div>

                <div class="descan-list" style="margin-top: 8px;">
                    @foreach ($satuanStatistik as $satuan)
                        <div class="descan-card-row" style="grid-template-columns: 1fr auto;">
                            <span>
                                <span class="descan-title">{{ $satuan->judul_satuan }}</span>
                                <span class="descan-subtitle">{{ $satuan->tabel_statistik_count }} data</span>
                            </span>
                            <span class="descan-actions">
                                <span class="descan-action descan-action-edit" aria-hidden="true"></span>
                                <span class="descan-action descan-action-delete" aria-hidden="true"></span>
                            </span>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <section class="descan-panel descan-table-panel">
            <div class="descan-panel-header">
                <span>Tabel Statistik</span>
                <a class="descan-primary-button" href="{{ \App\Filament\Resources\TabelStatistikResource::getUrl('create') }}">+ Tambah Tabel</a>
                <span class="descan-count">{{ $tabelStatistik->count() }}</span>
            </div>

            <table class="descan-table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tabelStatistik as $tabel)
                        <tr>
                            <td>{{ $tabel->judul_tabel }}</td>
                            <td><span class="descan-badge" style="background: #16843d; color: #eafff3;">{{ $tabel->kategori?->judul_kategori }}</span></td>
                            <td><span class="descan-badge">{{ $tabel->is_active ? 'Aktif' : 'Draft' }}</span></td>
                            <td>
                                <span class="descan-actions">
                                    <a class="descan-action descan-action-edit" href="{{ \App\Filament\Resources\TabelStatistikResource::getUrl('edit', ['record' => $tabel]) }}" aria-label="Edit {{ $tabel->judul_tabel }}"></a>
                                    <span class="descan-action descan-action-delete" aria-hidden="true"></span>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</x-filament-panels::page>
