<?php

namespace App\Filament\Resources\KategoriStatistikResource\Widgets;

use App\Models\SatuanStatistik;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class SatuanStatistikTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(SatuanStatistik::query()->latest())
            ->heading('Satuan Statistik')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Satuan')
                    ->modalHeading('Tambah Satuan Statistik')
                    ->modalDescription('Informasi Satuan')
                    ->form([
                        TextInput::make('judul_satuan')
                            ->label('Judul Satuan')
                            ->placeholder('Contoh: Jiwa, Persen, Ribu Rupiah')
                            ->required(),
                    ]),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('judul_satuan')
                    ->label('Satuan Statistik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tabelStatistik_count')
                    ->label('Jumlah Tabel')
                    ->counts('tabelStatistik')
                    ->badge()
                    ->color('info'),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('judul_satuan')
                            ->label('Judul Satuan')
                            ->placeholder('Contoh: Jiwa, Persen, Ribu Rupiah')
                            ->required(),
                    ]),
                DeleteAction::make(),
            ]);
    }
}
