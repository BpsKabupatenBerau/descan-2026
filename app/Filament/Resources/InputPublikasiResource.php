<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputPublikasiResource\Pages;
use App\Models\InputPublikasi;
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

class InputPublikasiResource extends Resource
{
    protected static ?string $model           = InputPublikasi::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-document-text';
    protected static string|UnitEnum|null   $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Publikasi / Dokumen';
    protected static ?int    $navigationSort  = 3;
    protected static ?string $modelLabel      = 'Publikasi';

    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Dokumen')
                ->schema([
                    TextInput::make('judul_publikasi')
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

                    Textarea::make('deskripsi_publikasi')
                        ->label('Deskripsi')
                        ->rows(4)
                        ->nullable(),

                    Select::make('kategori_publikasi_id')
                        ->label('Kategori Publikasi')
                        ->relationship('kategoriPublikasi', 'kategori')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->createOptionForm([
                            TextInput::make('kategori')
                                ->label('Nama Kategori Baru')
                                ->required(),
                        ]),

                    Select::make('tahun_id')
                        ->label('Tahun Publikasi')
                        ->relationship('tahun', 'tahun')
                        ->searchable()
                        ->required(),

                    TextInput::make('penulis')
                        ->label('Penulis / Penyusun')
                        ->nullable(),
                ])
                ->columns(2),

            Section::make('Upload Dokumen PDF')
                ->schema([
                    FileUpload::make('file_publikasi')
                        ->label('File PDF')
                        ->acceptedFileTypes(['application/pdf'])
                        ->directory('publikasi')
                        ->disk('public')
                        ->required()
                        ->maxSize(51200)
                        ->helperText('Format: PDF · Maks 50 MB')
                        ->afterStateUpdated(function ($state, \Filament\Forms\Set $set) {
                            if ($state) {
                                $set('nama_file_unduhan', basename($state));
                            }
                        }),

                    TextInput::make('nama_file_unduhan')
                        ->label('Nama File Unduhan')
                        ->helperText('Nama file yang tampil saat pengguna mengunduh')
                        ->nullable(),

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
                Tables\Columns\TextColumn::make('judul_publikasi')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('kategoriPublikasi.kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('tahun.tahun')
                    ->label('Tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('penulis')
                    ->label('Penulis')
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('download_count')
                    ->label('Unduhan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_publikasi_id')
                    ->label('Kategori')
                    ->relationship('kategoriPublikasi', 'kategori'),
                Tables\Filters\SelectFilter::make('tahun_id')
                    ->label('Tahun')
                    ->relationship('tahun', 'tahun'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('lihat_pdf')
                    ->label('Lihat PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('info')
                    ->url(fn(InputPublikasi $record) => asset('storage/'.$record->file_publikasi))
                    ->openUrlInNewTab(),
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
            'index'  => Pages\ListInputPublikasi::route('/'),
            'create' => Pages\CreateInputPublikasi::route('/create'),
            'edit'   => Pages\EditInputPublikasi::route('/{record}/edit'),
        ];
    }
}
