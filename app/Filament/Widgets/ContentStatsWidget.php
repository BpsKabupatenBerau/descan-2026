<?php

namespace App\Filament\Widgets;

use App\Models\InputDataSpasial;
use App\Models\InputInfografis;
use App\Models\InputPublikasi;
use App\Models\TabelStatistik;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Tabel Statistik', TabelStatistik::count())
                ->description('Total data statistik terdaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([3, 7, 10, 14, 18, 20, 24]),

            Stat::make('Titik Peta', InputDataSpasial::count())
                ->description('Lokasi terdaftar di peta')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info'),

            Stat::make('Infografis', InputInfografis::count())
                ->description('Gambar infografis aktif')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),

            Stat::make('Publikasi', InputPublikasi::count())
                ->description(number_format(InputPublikasi::sum('download_count')).' total unduhan')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('danger'),
        ];
    }
}
