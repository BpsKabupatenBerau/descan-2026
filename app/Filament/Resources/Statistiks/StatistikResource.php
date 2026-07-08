<?php

namespace App\Filament\Resources\Statistiks;

use App\Filament\Resources\Statistiks\Pages\CreateStatistik;
use App\Filament\Resources\Statistiks\Pages\EditStatistik;
use App\Filament\Resources\Statistiks\Pages\ListStatistiks;
use App\Filament\Resources\Statistiks\Schemas\StatistikForm;
use App\Filament\Resources\Statistiks\Tables\StatistiksTable;
use App\Filament\Widgets\StatistikOverview;
use App\Models\Statistik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class StatistikResource extends Resource
{
    protected static ?string $model = Statistik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;

    // 2. Mengelompokkan Navigasi (Sidebar Group)
    protected static string|UnitEnum|null $navigationGroup = "Konten";

    // 3. Mengatur Urutan Menu di dalam Grup tersebut (Opsional)
    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = "statistik";
    protected static ?string $pluralModelLabel = "Statistik";

    public static function form(Schema $schema): Schema
    {
        return StatistikForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StatistiksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
                //
            ];
    }

    // Tambahkan method ini untuk merender widget di atas tabel:
    public static function getWidgets(): array
    {
        return [StatistikOverview::class];
    }

    public static function getPages(): array
    {
        return [
            "index" => ListStatistiks::route("/"),
            "create" => CreateStatistik::route("/create"),
            "edit" => EditStatistik::route("/{record}/edit"),
        ];
    }
}
