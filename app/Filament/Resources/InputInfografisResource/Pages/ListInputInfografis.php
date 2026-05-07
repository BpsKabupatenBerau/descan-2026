<?php

namespace App\Filament\Resources\InputInfografisResource\Pages;

use App\Filament\Resources\InputInfografisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputInfografis extends ListRecords
{
    protected static string $resource = InputInfografisResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
