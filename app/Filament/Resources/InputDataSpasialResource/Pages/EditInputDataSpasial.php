<?php

namespace App\Filament\Resources\InputDataSpasialResource\Pages;

use App\Filament\Resources\InputDataSpasialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputDataSpasial extends EditRecord
{
    protected static string $resource = InputDataSpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
