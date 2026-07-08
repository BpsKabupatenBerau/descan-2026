<?php

namespace App\Filament\Resources\KategoriStatistiks;

use App\Filament\Resources\KategoriStatistiks\Pages\CreateKategoriStatistik;
use App\Filament\Resources\KategoriStatistiks\Pages\EditKategoriStatistik;
use App\Filament\Resources\KategoriStatistiks\Pages\ListKategoriStatistiks;
use App\Filament\Resources\KategoriStatistiks\Schemas\KategoriStatistikForm;
use App\Filament\Resources\KategoriStatistiks\Tables\KategoriStatistiksTable;
use App\Filament\Resources\KategoriStatistiks\Tables\KategoriStatistiksTableKategori;
use App\Filament\Resources\KategoriStatistiks\Tables\KategoriStatistiksTableSatuan;
use App\Models\KategoriStatistik;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriStatistikResource extends Resource
{
    protected static ?string $model = KategoriStatistik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChartBarSquare;

    // 2. Mengelompokkan Navigasi (Sidebar Group)
    protected static string|UnitEnum|null $navigationGroup = "Master Data";

    // 3. Mengatur Urutan Menu di dalam Grup tersebut (Opsional)
    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = "Kategori Statistik";
    protected static ?string $pluralModelLabel = "Kategori Statistik";

    public static function form(Schema $schema): Schema
    {
        return KategoriStatistikForm::configure($schema);
    }
    // Mendaftarkan widget ke halaman ini
    protected function getHeaderWidgets(): array
    {
        return [
            KategoriStatistiksTableSatuan::class,
            KategoriStatistiksTableKategori::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [KategoriStatistiksTable::class];
    }

    public static function table(Table $table): Table
    {
        return KategoriStatistiksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListKategoriStatistiks::route("/"),
            "create" => CreateKategoriStatistik::route("/create"),
            "edit" => EditKategoriStatistik::route("/{record}/edit"),
        ];
    }
}
