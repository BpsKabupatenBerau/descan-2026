<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputInfografisResource\Pages;
use App\Models\InputInfografis;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class InputInfografisResource extends Resource
{
    protected static ?string $model           = InputInfografis::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-photo';
    protected static string|UnitEnum|null   $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Infografis';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel      = 'Infografis';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Infografis')
                ->schema([
                    TextInput::make('judul_infografis')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, \Filament\Forms\Set $set) =>
                            $set('slug', Str::slug($state))
                        ),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true),

                    Textarea::make('deskripsi_infografis')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->nullable(),

                    Select::make('kategori_id')
                        ->label('Kategori')
                        ->relationship('kategori', 'judul_kategori')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Select::make('tahun_id')
                        ->label('Tahun')
                        ->relationship('tahun', 'tahun')
                        ->searchable()
                        ->required(),

                    TextInput::make('sumber')
                        ->label('Sumber Data')
                        ->nullable(),
                ])
                ->columns(2),

            Section::make('Upload Gambar')
                ->schema([
                    FileUpload::make('file_infografis')
                        ->label('File Gambar')
                        ->image()
                        ->imageEditor()
                        ->directory('infografis')
                        ->disk('public')
                        ->required()
                        ->maxSize(10240)
                        ->helperText('Format: JPG, PNG, WebP · Maks 10 MB'),

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
            'index'  => Pages\ListInputInfografis::route('/'),
            'create' => Pages\CreateInputInfografis::route('/create'),
            'edit'   => Pages\EditInputInfografis::route('/{record}/edit'),
        ];
    }
}
