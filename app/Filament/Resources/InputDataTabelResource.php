<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputDataTabelResource\Pages;
use App\Models\InputDataTabel;
use App\Models\TabelStatistik;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;

class InputDataTabelResource extends Resource
{
    protected static ?string $model           = InputDataTabel::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-table-cells';
    protected static string|UnitEnum|null   $navigationGroup = 'Statistik';
    protected static ?string $navigationLabel = 'Input Data Statistik';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel      = 'Input Data';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Pilih Tabel & Periode')
                ->schema([
                    Select::make('tabel_statistik_id')
                        ->label('Tabel Statistik')
                        ->relationship('tabelStatistik', 'judul_tabel')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->live()
                        ->afterStateUpdated(function ($state, \Filament\Forms\Set $set) {
                            if ($state) {
                                $tabel = TabelStatistik::find($state);
                                if ($tabel) {
                                    $set('kategori_id', $tabel->kategori_id);
                                }
                            }
                        }),

                    Select::make('kategori_id')
                        ->label('Kategori')
                        ->relationship('kategori', 'judul_kategori')
                        ->required()
                        ->disabled()
                        ->dehydrated(),

                    Select::make('tahun_id')
                        ->label('Tahun Data')
                        ->relationship('tahun', 'tahun')
                        ->searchable()
                        ->required(),

                    Select::make('bulan_id')
                        ->label('Bulan (Opsional)')
                        ->relationship('bulan', 'nama')
                        ->searchable()
                        ->nullable()
                        ->helperText('Kosongkan untuk data tahunan'),
                ])
                ->columns(2),

            Section::make('Nilai Data')
                ->schema([
                    TextInput::make('label_baris')
                        ->label('Label / Baris')
                        ->placeholder('Contoh: Laki-laki, SD, Dusun I')
                        ->helperText('Label yang ditampilkan di sumbu X chart atau baris tabel'),

                    TextInput::make('nilai')
                        ->label('Nilai')
                        ->numeric()
                        ->required()
                        ->placeholder('Contoh: 4872'),

                    FileUpload::make('file_excel')
                        ->label('Upload Excel (Opsional)')
                        ->acceptedFileTypes([
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ])
                        ->directory('excel-uploads')
                        ->disk('public')
                        ->nullable()
                        ->helperText('Upload file Excel sumber data (.xls / .xlsx)'),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ])
                ->columns(2),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
