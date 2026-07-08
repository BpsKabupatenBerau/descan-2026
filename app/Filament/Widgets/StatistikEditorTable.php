<?php

namespace App\Filament\Widgets;

use App\Models\Statistik; // Pastikan model ini sesuai
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Actions\EditAction;

class StatistikEditorTable extends BaseWidget
{
    // Mengambil porsi 2 dari 3 kolom (Lebar 2/3)
    protected int|string|array $columnSpan = 1;

    protected static ?string $heading = "Statistik - Editor Chart";
    protected static ?string $description = "Daftar data statistik terkini";

    public function table(Table $table): Table
    {
        return $table
            ->query(Statistik::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make("judul")->label("Judul"),
                Tables\Columns\TextColumn::make("kategori.judul")
                    ->label("Kategori")
                    ->badge(),
                Tables\Columns\TextColumn::make("tipe_chart")
                    ->label("Tipe")
                    ->badge()
                    ->color("gray"),
                Tables\Columns\TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->formatStateUsing(fn($state) => $state ? "Aktif" : "Draft")
                    ->color(fn($state) => $state ? "success" : "warning"),
            ])
            ->actions([EditAction::make()->iconButton()])
            ->paginated(false); // Sembunyikan pagination agar terlihat rapi seperti dashboard
    }
}
