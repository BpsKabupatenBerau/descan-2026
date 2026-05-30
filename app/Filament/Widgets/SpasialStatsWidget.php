<?php

namespace App\Filament\Widgets;

use App\Models\InputDataSpasial;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SpasialStatsWidget extends BaseWidget
{
    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        $total   = InputDataSpasial::count();
        $aktif   = InputDataSpasial::where('is_active', true)->count();
        $nonaktif = InputDataSpasial::where('is_active', false)->count();

        return [
            Stat::make('Total Lokasi', $total)
                ->description('Total titik lokasi spasial')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary'),

            Stat::make('Aktif', $aktif)
                ->description('Lokasi ditampilkan di peta')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Nonaktif', $nonaktif)
                ->description('Lokasi disembunyikan')
                ->descriptionIcon('heroicon-m-eye-slash')
                ->color('danger'),
        ];
    }
}
