<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputDataSpasialResource\Pages;
use App\Models\InputDataSpasial;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class InputDataSpasialResource extends Resource
{
    protected static ?string $model           = InputDataSpasial::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-map-pin';
    protected static string|UnitEnum|null   $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Spasial/Peta';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel      = 'Lokasi Spasial';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)
                ->columnSpanFull()
                ->schema([
                    Section::make('Informasi Lokasi')
                        ->schema([
                    Select::make('kategori_id')
                        ->label('Kategori')
                        ->relationship('kategori', 'judul_kategori')
                        ->searchable()
                        ->preload()
                        ->placeholder('- Pilih Kategori -')
                        ->required(),

                    TextInput::make('nama_lokasi')
                        ->label('Nama Lokasi')
                        ->required()
                        ->placeholder('Contoh: Puskesmas Desa Contoh'),

                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->nullable(),

                    Textarea::make('alamat_lengkap')
                        ->label('Alamat Lengkap')
                        ->rows(2)
                        ->nullable(),

                    TextInput::make('telepon')
                        ->label('Nomor Telepon')
                        ->tel()
                        ->nullable()
                        ->placeholder('+62 812-xxxx-xxxx'),

                    TextInput::make('website')
                        ->label('Website')
                        ->url()
                        ->nullable()
                        ->placeholder('https://'),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->helperText('Tampilkan di halaman publik')
                        ->default(true)
                        ->columnSpanFull(),
                        ])
                        ->columns(1),

            Section::make('Koordinat GPS')
                ->description('💡 Tip: Salin koordinat dari Google Maps')
                ->schema([
                    TextInput::make('latitude')
                        ->label('Latitude (Lintang)')
                        ->numeric()
                        ->required()
                        ->placeholder('-1.2379')
                        ->helperText('Contoh: -1.2379')
                        ->live(onBlur: true),

                    TextInput::make('longitude')
                        ->label('Longitude (Bujur)')
                        ->numeric()
                        ->required()
                        ->placeholder('116.8529')
                        ->helperText('Contoh: 116.8529')
                        ->live(onBlur: true),

                    \Filament\Forms\Components\Placeholder::make('map_preview')
                        ->label('Pratinjau Peta')
                        ->columnSpanFull()
                        ->content(view('filament.components.map-preview')),
                ])
                ->columns(2),

            Section::make('Data Tambahan')
                ->schema([
                    KeyValue::make('extra_data')
                        ->label('Data Tambahan (Opsional)')
                        ->keyLabel('Nama Field')
                        ->valueLabel('Nilai')
                        ->addButtonLabel('+ Tambah Field')
                        ->nullable()
                        ->columnSpanFull(),
                ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->searchPlaceholder('Cari nama lokasi..')
            ->columns([
                Tables\Columns\TextColumn::make('nama_lokasi')
                    ->label('Nama Lokasi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.judul_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('alamat_lengkap')
                    ->label('Alamat')
                    ->limit(40)
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('latitude')
                    ->label('Latitude')
                    ->numeric(decimalPlaces: 4),
                Tables\Columns\TextColumn::make('longitude')
                    ->label('Longitude')
                    ->numeric(decimalPlaces: 4),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->color(fn(bool $state): string => $state ? 'success' : 'danger')
                    ->formatStateUsing(fn(bool $state): string => $state ? 'Aktif' : 'Nonaktif'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'judul_kategori'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInputDataSpasial::route('/'),
            'create' => Pages\CreateInputDataSpasial::route('/create'),
            'edit'   => Pages\EditInputDataSpasial::route('/{record}/edit'),
        ];
    }
}
