<?php

namespace App\Filament\Resources\InputDataTabelResource\Pages;

use App\Filament\Resources\InputDataTabelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputDataTabel extends EditRecord
{
    protected static string $resource = InputDataTabelResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
