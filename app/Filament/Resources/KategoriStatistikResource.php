<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriStatistikResource\Pages;
use App\Models\KategoriStatistik;
// ─── Filament 5: Schema replaces Form for the wrapper ────────
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
// ─── Form fields still live in Forms\Components ──────────────
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
// ─── Tables unchanged ────────────────────────────────────────
use Filament\Resources\Resource;
use UnitEnum;
use BackedEnum;

use Filament\Tables;
use Filament\Tables\Table;

class KategoriStatistikResource extends Resource
{
    protected static ?string $model           = KategoriStatistik::class;
    protected static string|BackedEnum|null $navigationIcon  = 'heroicon-o-folder';
    protected static string|UnitEnum|null   $navigationGroup = 'Master Data';
    protected static ?string $navigationLabel = 'Kategori Statistik';
    protected static ?int    $navigationSort  = 1;
    protected static ?string $modelLabel      = 'Kategori Statistik';

    // ── Filament 5: schema() replaces form() ─────────────────
    public static function schema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()->schema([
                TextInput::make('judul_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Kependudukan'),

                FileUpload::make('logo_kategori')
                    ->label('Logo / Ikon Kategori')
                    ->image()
                    ->directory('kategori-statistik')
                    ->disk('public')
                    ->nullable()
                    ->helperText('PNG/SVG transparan, ukuran min 64×64px'),

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
                Tables\Columns\ImageColumn::make('logo_kategori')
                    ->label('Logo')
                    ->disk('public')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('judul_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tabelStatistik_count')
                    ->label('Jumlah Tabel')
                    ->counts('tabelStatistik')
                    ->badge()
                    ->color('info'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('user.nama_lengkap')
                    ->label('Dibuat oleh'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable(),
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
            'index'  => Pages\ListKategoriStatistik::route('/'),
            'create' => Pages\CreateKategoriStatistik::route('/create'),
            'edit'   => Pages\EditKategoriStatistik::route('/{record}/edit'),
        ];
    }
}
