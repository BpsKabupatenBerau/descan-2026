<?php

namespace App\Filament\Resources\KategoriSpasials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class KategoriSpasialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make("logo")
                    ->label("")
                    ->circular() // Menampilkan gambar secara membulat
                    ->defaultImageUrl(url("/images/default-placeholder.png")), // Ganti dengan path placeholder Anda jika kosong

                TextColumn::make("judul")
                    ->label("Kategori Spasial")
                    ->searchable()
                    ->sortable()
                    ->weight("bold"),

                TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => $state ? "Aktif" : "Nonaktif",
                    )
                    ->color(fn($state) => $state ? "success" : "danger"),
            ])
            ->filters([
                //
            ])
            ->recordActions([EditAction::make(), DeleteAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
