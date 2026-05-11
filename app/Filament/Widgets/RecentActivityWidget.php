<?php

namespace App\Filament\Widgets;

use App\Models\TabelStatistik;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentActivityWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Tabel Statistik Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(TabelStatistik::query()->latest()->limit(8))
            ->columns([
                Tables\Columns\TextColumn::make('judul_tabel')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.judul_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('tipe_chart')
                    ->label('Tipe')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable(),
            ]);
    }
}
