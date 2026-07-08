<?php

namespace App\Filament\Resources\Spasials;

use App\Filament\Resources\Spasials\Pages\CreateSpasial;
use App\Filament\Resources\Spasials\Pages\EditSpasial;
use App\Filament\Resources\Spasials\Pages\ListSpasials;
use App\Filament\Resources\Spasials\Schemas\SpasialForm;
use App\Filament\Resources\Spasials\Tables\SpasialsTable;
use App\Models\Spasial;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SpasialResource extends Resource
{
    protected static ?string $model = Spasial::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;
    protected static ?string $navigationLabel = "Spasial / Peta";
    // 2. Mengelompokkan Navigasi (Sidebar Group)
    protected static string|UnitEnum|null $navigationGroup = "Konten";

    // 3. Mengatur Urutan Menu di dalam Grup tersebut (Opsional)
    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = "Spasial";
    protected static ?string $pluralModelLabel = "Spasial";
    
    public static function form(Schema $schema): Schema
    {
        return SpasialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpasialsTable::configure($table);
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
            "index" => ListSpasials::route("/"),
            "create" => CreateSpasial::route("/create"),
            "edit" => EditSpasial::route("/{record}/edit"),
        ];
    }
}
