<?php

namespace App\Filament\Resources\Publikasis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PublikasisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("judul")->searchable()->limit(40),
                TextColumn::make("kategori")->badge()->color("warning"), // Warna bisa disesuaikan
                TextColumn::make("tahun"),
                TextColumn::make("penulis")->label("Diupload Oleh"),
                TextColumn::make("ukuran_file")
                    ->label("Ukuran")
                    ->default("2,4 MB"), // Angka statis sementara jika belum ada logic kalkulasi ukuran
                TextColumn::make("jumlah_unduhan")->label("Unduhan")->numeric(),
                TextColumn::make("status")
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? "Aktif" : "Draft")
                    ->color(fn($state) => $state ? "success" : "warning"),
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
