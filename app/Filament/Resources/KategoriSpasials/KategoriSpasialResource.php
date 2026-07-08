<?php

namespace App\Filament\Resources\KategoriSpasials;

use App\Filament\Resources\KategoriSpasials\Pages\CreateKategoriSpasial;
use App\Filament\Resources\KategoriSpasials\Pages\EditKategoriSpasial;
use App\Filament\Resources\KategoriSpasials\Pages\ListKategoriSpasials;
use App\Filament\Resources\KategoriSpasials\Schemas\KategoriSpasialForm;
use App\Filament\Resources\KategoriSpasials\Tables\KategoriSpasialsTable;
use App\Models\KategoriSpasial;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriSpasialResource extends Resource
{
    protected static ?string $model = KategoriSpasial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Map;

    // 2. Mengelompokkan Navigasi (Sidebar Group)
    protected static string|UnitEnum|null $navigationGroup = "Master Data";

    // 3. Mengatur Urutan Menu di dalam Grup tersebut (Opsional)
    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = "Kategori Spasial";
    protected static ?string $pluralModelLabel = "Kategori Spasial";

    public static function form(Schema $schema): Schema
    {
        return KategoriSpasialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriSpasialsTable::configure($table);
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
            "index" => ListKategoriSpasials::route("/"),
            "create" => CreateKategoriSpasial::route("/create"),
            "edit" => EditKategoriSpasial::route("/{record}/edit"),
        ];
    }
}
