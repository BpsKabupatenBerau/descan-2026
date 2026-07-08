<?php

namespace App\Filament\Widgets;

// 1. Import semua Model yang dibutuhkan
use App\Models\Statistik;
use App\Models\Spasial; // Sesuaikan jika nama model Spasial/Peta Anda berbeda
use App\Models\Infografis;
use App\Models\Publikasi;

// 2. Import Carbon untuk manipulasi tanggal
use Carbon\Carbon;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    // Memaksa widget ini membentang penuh dari ujung ke ujung
    protected int|string|array $columnSpan = "full";

    protected function getStats(): array
    {
        // Persiapan variabel waktu untuk filter data bulan ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // --- MENGAMBIL DATA DARI DATABASE ---

        // 1. Data Total Statistik
        $totalStatistik = Statistik::count();
        $statistikBulanIni = Statistik::whereMonth("created_at", $bulanIni)
            ->whereYear("created_at", $tahunIni)
            ->count();

        // 2. Data Titik Peta
        $totalPeta = Spasial::count();
        $petaBulanIni = Spasial::whereMonth("created_at", $bulanIni)
            ->whereYear("created_at", $tahunIni)
            ->count();

        // 3. Data Infografis
        $totalInfografis = Infografis::count();
        $infografisBulanIni = Infografis::whereMonth("created_at", $bulanIni)
            ->whereYear("created_at", $tahunIni)
            ->count();

        // 4. Data Publikasi & Unduhan
        $totalPublikasi = Publikasi::count();

        /*
         * Catatan untuk Jumlah Unduhan:
         * Jika Anda memiliki kolom 'jumlah_unduhan' di tabel publikasi, gunakan fungsi sum() di bawah ini.
         * Jika belum punya kolom tersebut di database, Anda bisa membiarkannya statis sementara.
         */
        // $totalUnduhan = Publikasi::sum('jumlah_unduhan');
        $totalUnduhan = Publikasi::sum("jumlah_unduhan");

        // --- MENAMPILKAN KE DALAM WIDGET ---
        return [
            Stat::make("Total Statistik", $totalStatistik)
                ->icon("heroicon-o-chart-bar") // Ikon utama card
                ->description("+{$statistikBulanIni} bulan ini")
                ->descriptionIcon("heroicon-m-arrow-trending-up")
                ->color("warning"),

            Stat::make("Titik Peta", $totalPeta)
                ->icon("heroicon-o-map") // Ikon utama card
                ->description("+{$petaBulanIni} bulan ini")
                ->descriptionIcon("heroicon-m-arrow-trending-up")
                ->color("success"),

            Stat::make("Infografis", $totalInfografis)
                ->icon("heroicon-o-photo") // Ikon utama card
                ->description("+{$infografisBulanIni} bulan ini")
                ->descriptionIcon("heroicon-m-arrow-trending-up")
                ->color("info"),

            Stat::make("Publikasi", $totalPublikasi)
                ->icon("heroicon-o-document-text") // Ikon utama card
                ->description(
                    number_format($totalUnduhan, 0, ",", ".") . " unduhan",
                )
                ->descriptionIcon("heroicon-m-arrow-down-tray")
                ->color("warning"),
        ];
    }
}
