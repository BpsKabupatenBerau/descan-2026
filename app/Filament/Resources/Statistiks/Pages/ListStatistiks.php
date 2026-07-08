<?php

namespace App\Filament\Resources\Statistiks\Pages;

use App\Filament\Resources\Statistiks\StatistikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\StatistikOverview;

class ListStatistiks extends ListRecords
{
    protected static string $resource = StatistikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label("+ Tambah Statistik") // Mengubah teks tombol
                ->color("success"),
            // Mengubah warna tombol menjadi hijau sesuai gambar image_877c9a.png,
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [StatistikOverview::class];
    }
}
