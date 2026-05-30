<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriSpasialResource\Pages;
use App\Models\KategoriSpasial;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions;

class KategoriSpasialResource extends Resource
{
    protected static ?string $model                  = KategoriSpasial::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-map-pin';
    protected static string|UnitEnum|null   $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel        = 'Kategori Spasial';
    protected static ?int    $navigationSort         = 2;
    protected static ?string $modelLabel             = 'Kategori Spasial';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Kategori')->schema([
                TextInput::make('judul_kategori')
                    ->label('Judul Kategori')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Pariwisata')
                    ->columnSpanFull(),

                FileUpload::make('logo_kategori')
                    ->label('Marker / Ikon')
                    ->image()
                    ->directory('kategori-spasial')
                    ->disk('public')
                    ->nullable()
                    ->maxSize(1024)
                    ->helperText('Drag & drop ikon di sini atau Pilih File. Format: PNG/SVG transparan Maks 1 MB')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->label('Aktif')
                    ->helperText('Centang untuk menampilkan di website')
                    ->default(true)
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('spasial_count')
                    ->label('Jumlah Lokasi')
                    ->counts('spasial')
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
            'index'  => Pages\ListKategoriSpasial::route('/'),
            'create' => Pages\CreateKategoriSpasial::route('/create'),
            'edit'   => Pages\EditKategoriSpasial::route('/{record}/edit'),
        ];
    }
}
