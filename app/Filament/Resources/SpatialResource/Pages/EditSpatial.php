<?php

namespace App\Filament\Resources\SpatialResource\Pages;

use App\Filament\Resources\SpatialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpatial extends EditRecord
{
    protected static string $resource = SpatialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
