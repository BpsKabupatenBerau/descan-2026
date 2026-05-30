<?php

namespace App\Filament\Resources\KategoriStatistikResource\Widgets;

use App\Models\KategoriStatistik;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class KategoriStatistikTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(KategoriStatistik::query()->latest())
            ->heading('Kategori Statistik')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Kategori')
                    ->modalHeading('Tambah Kategori Statistik')
                    ->modalDescription('Informasi Kategori')
                    ->form([
                        TextInput::make('judul_kategori')
                            ->label('Judul Kategori')
                            ->placeholder('Contoh: Kependudukan')
                            ->required(),
                        FileUpload::make('logo_kategori')
                            ->label('Logo')
                            ->image()
                            ->directory('kategori-statistik')
                            ->disk('public')
                            ->helperText('PNG/SVG transparan, ukuran min 64×64px'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->helperText('Centang untuk menampilkan di website')
                            ->default(true),
                    ]),
            ])
            ->columns([
                Tables\Columns\ImageColumn::make('logo_kategori')
                    ->label('Logo')
                    ->disk('public')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('judul_kategori')
                    ->label('Kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tabelStatistik_count')
                    ->label('Jumlah Tabel')
                    ->counts('tabelStatistik')
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->actions([
                EditAction::make()
                    ->form([
                        TextInput::make('judul_kategori')
                            ->label('Judul Kategori')
                            ->placeholder('Contoh: Kependudukan')
                            ->required(),
                        FileUpload::make('logo_kategori')
                            ->label('Logo')
                            ->image()
                            ->directory('kategori-statistik')
                            ->disk('public')
                            ->helperText('PNG/SVG transparan, ukuran min 64×64px'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->helperText('Centang untuk menampilkan di website')
                            ->default(true),
                    ]),
                DeleteAction::make(),
            ]);
    }
}
