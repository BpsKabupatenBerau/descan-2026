<?php

namespace App\Filament\Widgets;

use App\Models\TabelStatistik;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatistikStatsWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $total   = TabelStatistik::count();
        $aktif   = TabelStatistik::where('is_active', true)->count();
        $draft   = TabelStatistik::where('is_active', false)->count();

        return [
            Stat::make('Total Data', $total)
                ->description('Total tabel statistik')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('primary'),

            Stat::make('Aktif', $aktif)
                ->description('Ditampilkan di halaman publik')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Draft', $draft)
                ->description('Belum ditampilkan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
