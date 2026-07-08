<?php

namespace App\Filament\Resources\Spasials\Widgets;

use App\Models\Spasial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SpasialOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total Lokasi", Spasial::count())
                ->description("Jumlah seluruh titik lokasi")
                ->icon("heroicon-o-map-pin"),

            Stat::make("Kategori", Spasial::distinct("kategori")->count())
                ->description("Jumlah kategori yang tersedia")
                ->icon("heroicon-o-folder"),

            Stat::make("Aktif", Spasial::where("status", true)->count())
                ->description("Lokasi yang aktif dipublikasikan")
                ->icon("heroicon-o-check-circle")
                ->color("success"),

            Stat::make("Nonaktif", Spasial::where("status", false)->count())
                ->description("Lokasi yang dinonaktifkan")
                ->icon("heroicon-o-exclamation-triangle")
                ->color("danger"),
        ];
    }
}
