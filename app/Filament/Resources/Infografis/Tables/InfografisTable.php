<?php

namespace App\Filament\Resources\Infografis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class InfografisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("judul")
                    ->label("Judul")
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
                TextColumn::make("tahun")->label("Tahun")->limit(30),
                TextColumn::make("status")
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => $state ? "Aktif" : "Nonaktif",
                    )
                    ->color(fn($state) => $state ? "success" : "danger"),
            ])
            ->recordActions([EditAction::make()])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
