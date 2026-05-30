<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputInfografisResource\Pages;
use App\Models\InputInfografis;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use BackedEnum;
use UnitEnum;

class InputInfografisResource extends Resource
{
    protected static ?string $model = InputInfografis::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';
    protected static string|UnitEnum|null $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Infografis';
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Infografis';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)
                ->columnSpanFull()
                ->schema([
                    Section::make('Informasi Infografis')
                        ->schema([
                            TextInput::make('judul_infografis')
                                ->label('Judul')
                                ->placeholder('Contoh: Piramida Penduduk 2024')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, \Filament\Forms\Set $set) => $set('slug', Str::slug($state)))
                                ->columnSpanFull(),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->hidden(),

                            Textarea::make('deskripsi_infografis')
                                ->label('Deskripsi')
                                ->placeholder('Keterangan singkat...')
                                ->rows(3)
                                ->nullable()
                                ->columnSpanFull(),

                            Select::make('kategori_id')
                                ->label('Kategori')
                                ->relationship('kategori', 'judul_kategori')
                                ->searchable()
                                ->preload()
                                ->placeholder('Kependudukan / Kesehatan / dll')
                                ->required()
                                ->columnSpanFull(),

                            Select::make('tahun_id')
                                ->label('Tahun Data')
                                ->relationship('tahun', 'tahun')
                                ->searchable()
                                ->placeholder('2024')
                                ->required()
                                ->columnSpanFull(),

                            TextInput::make('sumber')
                                ->label('Sumber')
                                ->placeholder('Contoh: Disdukcapil 2024')
                                ->nullable()
                                ->columnSpanFull(),

                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->helperText('Tampilkan di halaman publik')
                                ->default(true)
                                ->columnSpanFull(),
                        ]),

                    Grid::make(1)
                        ->schema([
                            Section::make('Upload Gambar')
                                ->schema([
                                    FileUpload::make('file_infografis')
                                        ->label('')
                                        ->image()
                                        ->imageEditor()
                                        ->directory('infografis')
                                        ->disk('public')
                                        ->required()
                                        ->maxSize(10240)
                                        ->helperText('Format: JPG, PNG, WebP - Maks 10 MB'),
                                ]),

                            Section::make('Pratinjau Gambar')
                                ->schema([
                                    Placeholder::make('pratinjau_gambar')
                                        ->label('')
                                        ->content('Gambar akan tampil di sini setelah upload'),
                                ]),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_infografis')
                    ->label('Gambar')
                    ->disk('public')
                    ->square()
                    ->size(56),
                Tables\Columns\TextColumn::make('judul_infografis')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('kategori.judul_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('tahun.tahun')
                    ->label('Tahun')
                    ->sortable(),
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
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInputInfografis::route('/'),
            'create' => Pages\CreateInputInfografis::route('/create'),
            'edit' => Pages\EditInputInfografis::route('/{record}/edit'),
        ];
    }
}
