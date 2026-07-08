<?php

namespace App\Filament\Resources\KategoriStatistiks\Pages;

use App\Filament\Resources\KategoriStatistiks\KategoriStatistikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriStatistiks extends ListRecords
{
    protected static string $resource = KategoriStatistikResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
