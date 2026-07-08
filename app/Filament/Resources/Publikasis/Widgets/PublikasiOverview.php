<?php

namespace App\Filament\Resources\Publikasis\Widgets;

use App\Models\Publikasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PublikasiOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Total Dokumen", Publikasi::count())->icon(
                "heroicon-o-document",
            ),

            // Mengambil total semua angka di kolom jumlah_unduhan
            Stat::make(
                "Total Unduhan",
                number_format(Publikasi::sum("jumlah_unduhan"), 0, ",", "."),
            )->icon("heroicon-o-arrow-down-tray"),

            Stat::make("Aktif", Publikasi::where("status", true)->count())
                ->icon("heroicon-o-check-circle")
                ->color("success"),

            Stat::make("Draft", Publikasi::where("status", false)->count())
                ->icon("heroicon-o-pencil-square")
                ->color("warning"),
        ];
    }
}
