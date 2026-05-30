<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputDataTabelResource\Pages;
use App\Models\InputDataTabel;
use App\Models\TabelStatistik;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class InputDataTabelResource extends Resource
{
    protected static ?string $model           = InputDataTabel::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-table-cells';
    protected static string|UnitEnum|null   $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Input Data Statistik';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel      = 'Input Data';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)
                ->columnSpanFull()
                ->schema([
                    Section::make('Informasi Statistik')
                        ->schema([
                            Select::make('kategori_id')
                                ->label('Kategori')
                                ->relationship('kategori', 'judul_kategori')
                                ->placeholder('-- Pilih Kategori --')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpanFull(),

                            Select::make('tabel_statistik_id')
                                ->label('Judul Tabel')
                                ->relationship('tabelStatistik', 'judul_tabel')
                                ->searchable()
                                ->preload()
                                ->placeholder('-- Pilih Tabel Statistik --')
                                ->required()
                                ->live()
                                ->default(request()->query('tabel_statistik_id'))
                                ->afterStateHydrated(function ($state, $set) {
                                    if ($state) {
                                        $tabel = TabelStatistik::find($state);
                                        if ($tabel) {
                                            $set('kategori_id', $tabel->kategori_id);
                                            $set('periode_data', $tabel->periode_data);
                                        }
                                    }
                                })
                                ->afterStateUpdated(function ($state, $set) {
                                    if ($state) {
                                        $tabel = TabelStatistik::find($state);
                                        if ($tabel) {
                                            $set('kategori_id', $tabel->kategori_id);
                                            $set('periode_data', $tabel->periode_data);
                                        }
                                    }
                                })
                                ->columnSpanFull(),

                            TextInput::make('periode_data')
                                ->label('Periode Data')
                                ->disabled()
                                ->dehydrated(false)
                                ->placeholder('-- Pilih Tahun --')
                                ->columnSpanFull(),

                            Select::make('tahun_id')
                                ->label(' ')
                                ->relationship('tahun', 'tahun')
                                ->searchable()
                                ->placeholder('-- Pilih Tahun --')
                                ->required()
                                ->columnSpanFull(),

                            Select::make('bulan_id')
                                ->label(' ')
                                ->relationship('bulan', 'nama')
                                ->searchable()
                                ->placeholder('-- Pilih Bulan (Apabila data terkecilnya bulan) --')
                                ->nullable()
                                ->columnSpanFull(),

                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->helperText('Tampilkan di halaman publik')
                                ->default(true)
                                ->columnSpanFull(),
                        ]),

                    Section::make('Upload Excel')
                        ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                        ->schema([
                            FileUpload::make('file_excel')
                                ->label('')
                                ->acceptedFileTypes([
                                    'application/vnd.ms-excel',
                                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                ])
                                ->directory('excel-uploads')
                                ->disk('public')
                                ->maxSize(10240)
                                ->helperText('Format: XLSX - Maks 10 MB')
                                ->required()
                                ->columnSpanFull(),
                        ]),
                ]),

            Section::make('Pratinjau Tabel')
                ->schema([
                    Placeholder::make('pratinjau')
                        ->label('')
                        ->content('Tabel akan tampil di sini setelah upload')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tabelStatistik.judul_tabel')
                    ->label('Tabel')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('kategori.judul_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('label_baris')
                    ->label('Label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai')
                    ->numeric(decimalPlaces: 0)
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahun.tahun')
                    ->label('Tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('bulan.nama')
                    ->label('Bulan')
                    ->placeholder('-'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tabel_statistik_id')
                    ->label('Tabel')
                    ->relationship('tabelStatistik', 'judul_tabel'),
                Tables\Filters\SelectFilter::make('tahun_id')
                    ->label('Tahun')
                    ->relationship('tahun', 'tahun'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInputDataTabel::route('/'),
            'create' => Pages\CreateInputDataTabel::route('/create'),
            'edit'   => Pages\EditInputDataTabel::route('/{record}/edit'),
        ];
    }
}
