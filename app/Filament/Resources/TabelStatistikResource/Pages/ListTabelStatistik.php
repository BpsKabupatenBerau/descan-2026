<?php

namespace App\Filament\Resources\TabelStatistikResource\Pages;

use App\Filament\Resources\TabelStatistikResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTabelStatistik extends ListRecords
{
    protected static string $resource = TabelStatistikResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
