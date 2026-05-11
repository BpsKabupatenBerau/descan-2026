<?php

namespace App\Filament\Resources\InputDataTabelResource\Pages;

use App\Filament\Resources\InputDataTabelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputDataTabel extends ListRecords
{
    protected static string $resource = InputDataTabelResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
