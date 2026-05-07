<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputDataSpasialResource\Pages;
use App\Models\InputDataSpasial;
use Filament\Schemas\Schema;
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

class InputDataSpasialResource extends Resource
{
    protected static ?string $model           = InputDataSpasial::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-map-pin';
    protected static string|UnitEnum|null   $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Spasial / Peta';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel      = 'Lokasi Spasial';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Lokasi')
                ->schema([
                    Select::make('kategori_id')
                        ->label('Kategori Spasial')
                        ->relationship('kategori', 'judul_kategori')
                        ->searchable()
                        ->preload()
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
                ])
                ->columns(2),

            Section::make('Koordinat GPS')
                ->description('💡 Tip: Buka Google Maps → klik lokasi → salin koordinat')
                ->schema([
                    TextInput::make('latitude')
                        ->label('Latitude (Lintang)')
                        ->numeric()
                        ->required()
                        ->placeholder('-1.2379000'),

                    TextInput::make('longitude')
                        ->label('Longitude (Bujur)')
                        ->numeric()
                        ->required()
                        ->placeholder('116.8529000'),
                ])
                ->columns(2),

            Section::make('Data Tambahan')
                ->schema([
                    KeyValue::make('extra_data')
                        ->label('Data Tambahan (Opsional)')
                        ->keyLabel('Nama Field')
                        ->valueLabel('Nilai')
                        ->addButtonLabel('+ Tambah Field')
                        ->nullable(),

                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
                    ->label('Lat')
                    ->numeric(decimalPlaces: 4),
                Tables\Columns\TextColumn::make('longitude')
                    ->label('Lng')
                    ->numeric(decimalPlaces: 4),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
