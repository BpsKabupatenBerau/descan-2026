<?php

namespace App\Filament\Resources\Infografis\Widgets;

use App\Models\Infografis;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InfografisOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total Infografis", Infografis::count())
                ->description("Total seluruh data infografis")
                ->icon("heroicon-o-photo"),

            Stat::make("Kategori", Infografis::distinct("kategori")->count())
                ->description("Jumlah variasi kategori")
                ->icon("heroicon-o-folder"),

            Stat::make("Aktif", Infografis::where("status", true)->count())
                ->description("Infografis yang tampil publik")
                ->icon("heroicon-o-check-circle")
                ->color("success"),

            Stat::make("Draft", Infografis::where("status", false)->count())
                ->description("Infografis dalam status draf")
                ->icon("heroicon-o-document-text")
                ->color("warning"),
        ];
    }
}
