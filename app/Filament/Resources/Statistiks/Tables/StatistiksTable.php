<?php

namespace App\Filament\Resources\Statistiks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class StatistiksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("judul")
                    ->label("Judul")
                    ->searchable()
                    ->sortable(),

                TextColumn::make("kategori")
                    ->label("Kategori")
                    ->badge()
                    ->color("success") // Warna hijau seragam sesuai gambar
                    ->searchable(),

                TextColumn::make("tipe_chart")
                    ->label("Tipe Chart")
                    ->badge()
                    ->color(
                        fn(string $state): string => match ($state) {
                            "number" => "info", // Biru terang
                            "bar" => "primary", // Biru gelap/Indigo
                            "doughnut" => "purple", // Ungu
                            "line" => "success", // Hijau
                            "pie" => "warning", // Oranye/Kuning
                            default => "gray",
                        },
                    ),

                TextColumn::make("tahun_terkini")
                    ->label("Tahun Terkini")
                    ->sortable(),

                TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->formatStateUsing(
                        fn(string $state): string => match ($state) {
                            "1" => "Aktif",
                            "0" => "Draft",
                            default => $state,
                        },
                    )
                    ->color(
                        fn(string $state): string => match ($state) {
                            "1" => "success", // Hijau jika 1
                            "0" => "gray", // Abu-abu jika 0
                            default => "primary",
                        },
                    ),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->emptyStateHeading("Belum ada data statistik");
    }
}
