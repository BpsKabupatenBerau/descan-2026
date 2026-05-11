<?php

namespace App\Filament\Resources\InputPublikasiResource\Pages;

use App\Filament\Resources\InputPublikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputPublikasi extends EditRecord
{
    protected static string $resource = InputPublikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
