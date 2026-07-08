<?php

namespace App\Filament\Resources\Spasials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class SpasialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("nama_lokasi")
                    ->label("Nama Lokasi")
                    ->searchable()
                    ->sortable(),
                TextColumn::make("kategori")->badge()->color(
                    fn(string $state): string => match ($state) {
                        "Pemerintahan" => "info",
                        "Kesehatan" => "success",
                        "Pendidikan" => "warning",
                        "Sarana Ibadah" => "purple",
                        default => "gray",
                    },
                ),
                TextColumn::make("alamat_lengkap")->label("Alamat")->limit(30),
                TextColumn::make("latitude")->label("Latitude"),
                TextColumn::make("longitude")->label("Longitude"),
                TextColumn::make("status")
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => $state ? "Aktif" : "Nonaktif",
                    )
                    ->color(fn($state) => $state ? "success" : "danger"),
            ])
            ->filters([
                SelectFilter::make("kategori")->options([
                    "Pemerintahan" => "Pemerintahan",
                    "Kesehatan" => "Kesehatan",
                    "Pendidikan" => "Pendidikan",
                ]),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
