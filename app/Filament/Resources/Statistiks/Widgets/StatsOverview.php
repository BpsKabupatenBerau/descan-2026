<?php

namespace App\Filament\Widgets; // Sesuaikan namespace dengan lokasi file Anda

use App\Models\Statistik;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatistikOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // 1. Total Data
            Stat::make("Total Data", Statistik::count())
                ->description("Total seluruh data statistik")
                ->icon("heroicon-o-chart-bar"),

            // 2. Total Kategori Unik
            Stat::make(
                "Kategori",
                Statistik::distinct("kategori")->count("kategori"),
            )
                ->description("Jumlah kategori yang ada")
                ->icon("heroicon-o-folder"),

            // 3. Total Tipe Chart Unik
            Stat::make(
                "Tipe Chart",
                Statistik::distinct("tipe_chart")->count("tipe_chart"),
            )
                ->description("Variasi tipe chart")
                ->icon("heroicon-o-presentation-chart-line"),

            // 4. Total Status Aktif
            Stat::make("Aktif", Statistik::where("status", "1")->count())
                ->description("Data berstatus aktif")
                ->icon("heroicon-o-check-circle")
                ->color("success"), // Memberikan aksen warna hijau
        ];
    }
}
