<?php

namespace App\Filament\Resources\Spasials\Pages;

use App\Filament\Resources\Spasials\SpasialResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpasial extends EditRecord
{
    protected static string $resource = SpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
