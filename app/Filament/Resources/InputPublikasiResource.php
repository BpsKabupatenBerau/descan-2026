<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InputPublikasiResource\Pages;
use App\Models\InputPublikasi;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
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

class InputPublikasiResource extends Resource
{
    protected static ?string $model = InputPublikasi::class;
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static string|UnitEnum|null $navigationGroup = 'Konten';
    protected static ?string $navigationLabel = 'Publikasi';
    protected static ?int $navigationSort = 4;
    protected static ?string $modelLabel = 'Publikasi';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make(2)
                ->columnSpanFull()
                ->schema([
                    Section::make('Informasi Dokumen')
                        ->schema([
                            TextInput::make('judul_publikasi')
                                ->label('Judul')
                                ->placeholder('Contoh: Monografi Desa 2024')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, \Filament\Forms\Set $set) => $set('slug', Str::slug($state)))
                                ->columnSpanFull(),

                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->hidden(),

                            Textarea::make('deskripsi_publikasi')
                                ->label('Deskripsi')
                                ->placeholder('Ringkasan isi dokumen...')
                                ->rows(4)
                                ->nullable()
                                ->columnSpanFull(),

                            Select::make('kategori_publikasi_id')
                                ->label('Kategori')
                                ->relationship('kategoriPublikasi', 'kategori')
                                ->searchable()
                                ->preload()
                                ->placeholder('Monografi / Laporan / Perdes / RKPD')
                                ->required()
                                ->createOptionForm([
                                    TextInput::make('kategori')
                                        ->label('Nama Kategori Baru')
                                        ->required(),
                                ])
                                ->columnSpanFull(),

                            Select::make('tahun_id')
                                ->label('Tahun Data')
                                ->relationship('tahun', 'tahun')
                                ->searchable()
                                ->placeholder('2024')
                                ->required()
                                ->columnSpanFull(),

                            TextInput::make('penulis')
                                ->label('Penulis / Penyusun')
                                ->placeholder('Contoh: Sekretaris Desa')
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
                            Section::make('Upload File PDF')
                                ->schema([
                                    FileUpload::make('file_publikasi')
                                        ->label('')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->directory('publikasi')
                                        ->disk('public')
                                        ->required()
                                        ->maxSize(51200)
                                        ->helperText('Format: PDF - Maks 50 MB')
                                        ->afterStateUpdated(function ($state, \Filament\Forms\Set $set) {
                                            if ($state) {
                                                $set('nama_file_unduhan', basename($state));
                                            }
                                        }),
                                ]),

                            Section::make('Info File')
                                ->schema([
                                    TextInput::make('nama_file_unduhan')
                                        ->label('')
                                        ->placeholder('monografi-desa-2024.pdf')
                                        ->nullable(),
                                ]),
                        ]),
                ]),
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
                Actions\EditAction::make(),
                Actions\Action::make('lihat_pdf')
                    ->label('Lihat PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('info')
                    ->url(fn (InputPublikasi $record) => asset('storage/' . $record->file_publikasi))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListInputPublikasi::route('/'),
            'create' => Pages\CreateInputPublikasi::route('/create'),
            'edit' => Pages\EditInputPublikasi::route('/{record}/edit'),
        ];
    }
}
