<?php

namespace App\Filament\Resources\InputPublikasiResource\Pages;

use App\Filament\Resources\InputPublikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputPublikasi extends ListRecords
{
    protected static string $resource = InputPublikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
