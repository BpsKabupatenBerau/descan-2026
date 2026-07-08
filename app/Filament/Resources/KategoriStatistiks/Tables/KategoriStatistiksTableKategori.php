<?php

namespace App\Filament\Resources\KategoriStatistiks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class KategoriStatistiksTableKategori
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("judul")->label("Judul"),
                TextColumn::make("kategori.judul")
                    ->label("Kategori")
                    ->badge()
                    ->color("success"),
                TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? "Aktif" : "Draft")
                    ->color(fn($state) => $state ? "success" : "gray"),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
