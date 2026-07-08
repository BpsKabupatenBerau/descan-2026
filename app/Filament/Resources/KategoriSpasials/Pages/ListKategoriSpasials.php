<?php

namespace App\Filament\Resources\KategoriSpasials\Pages;

use App\Filament\Resources\KategoriSpasials\KategoriSpasialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriSpasials extends ListRecords
{
    protected static string $resource = KategoriSpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label("+ Tambah Kategori")->color("success"),
        ];
    }
}
