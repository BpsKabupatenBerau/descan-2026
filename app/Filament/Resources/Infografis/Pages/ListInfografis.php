<?php

namespace App\Filament\Resources\Infografis\Pages;

use App\Filament\Resources\Infografis\InfografisResource;
use App\Filament\Resources\Infografis\Widgets\InfografisOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInfografis extends ListRecords
{
    protected static string $resource = InfografisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label("+ Tambah Infografis")
                ->color("success"),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            InfografisOverview::class, // <--- Daftarkan di sini
        ];
    }
}
