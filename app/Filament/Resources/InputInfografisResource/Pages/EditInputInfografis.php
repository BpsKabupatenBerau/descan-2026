<?php

namespace App\Filament\Resources\InputInfografisResource\Pages;

use App\Filament\Resources\InputInfografisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputInfografis extends EditRecord
{
    protected static string $resource = InputInfografisResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
