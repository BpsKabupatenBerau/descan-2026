<?php

namespace App\Filament\Resources\Spasials\Pages;

use App\Filament\Resources\Spasials\SpasialResource;
use Filament\Actions\CreateAction;
use App\Filament\Resources\Spasials\Widgets\SpasialOverview;
use Filament\Resources\Pages\ListRecords;

class ListSpasials extends ListRecords
{
    protected static string $resource = SpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label("+ Tambah Lokasi")->color("success"),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            SpasialOverview::class, // Daftarkan di sini
        ];
    }
}
