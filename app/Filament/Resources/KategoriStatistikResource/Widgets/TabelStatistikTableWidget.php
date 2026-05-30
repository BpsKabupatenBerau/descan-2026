<?php

namespace App\Filament\Resources\KategoriStatistikResource\Widgets;

use App\Models\TabelStatistik;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Section;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Str;

class TabelStatistikTableWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(TabelStatistik::query()->latest())
            ->heading('Tabel Statistik')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Tabel')
                    ->modalHeading('Tambah Tabel Statistik')
                    ->form($this->getFormSchema()),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('judul_tabel')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.judul_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('tipe_chart')
                    ->label('Tipe Chart')
                    ->badge()
                    ->color(fn(string $state): string => match($state) {
                        'bar'             => 'info',
                        'line'            => 'success',
                        'pie','doughnut'  => 'warning',
                        'number'          => 'danger',
                        default           => 'gray',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->actions([
                EditAction::make()
                    ->form($this->getFormSchema()),
                DeleteAction::make(),
            ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Informasi Tabel')
                ->schema([
                    TextInput::make('judul_tabel')
                        ->label('Judul Statistik')
                        ->placeholder('Contoh: Tingkat Pendidikan Penduduk')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, \Filament\Forms\Set $set) =>
                            $set('slug', Str::slug($state))
                        ),
                    TextInput::make('slug')->hidden(),
                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->placeholder('Penjelasan singkat tentang data ini..')
                        ->columnSpanFull(),
                    Select::make('kategori_id')
                        ->label('Kategori')
                        ->relationship('kategori', 'judul_kategori')
                        ->placeholder('- Pilih Kategori -')
                        ->required()
                        ->searchable(),
                    TagsInput::make('nama_baris')
                        ->label('Nama Baris')
                        ->placeholder('Tambah Field')
                        ->helperText('Ketik nama baris lalu tekan Enter')
                        ->columnSpanFull(),
                ])->columns(2),
            Section::make('Tipe & Tampilan')
                ->schema([
                    Select::make('tipe_chart')
                        ->label('Tipe Chart')
                        ->options([
                            'bar'       => 'bar',
                            'line'      => 'line',
                            'pie'       => 'pie',
                            'doughnut'  => 'doughnut',
                            'number'    => 'number',
                            'table'     => 'table',
                        ])
                        ->placeholder('- Pilih Tipe -')
                        ->required(),
                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->helperText('Centang untuk menampilkan di website')
                        ->default(true),
                ])->columns(2),
            Section::make('Metadata')
                ->schema([
                    TextInput::make('sumber_data')
                        ->label('Sumber Data')
                        ->placeholder('Contoh: Disdukcapil 2024'),
                    Select::make('satuan_id')
                        ->label('Satuan')
                        ->relationship('satuan', 'judul_satuan')
                        ->searchable()
                        ->placeholder('Jiwa / Rp'),
                    Select::make('periode_data')
                        ->label('Periode')
                        ->options([
                            'Tahunan'  => 'Tahunan',
                            'Bulanan'  => 'Bulanan',
                        ])
                        ->placeholder('Tahunan/Bulanan'),
                ])->columns(3),
        ];
    }
}
