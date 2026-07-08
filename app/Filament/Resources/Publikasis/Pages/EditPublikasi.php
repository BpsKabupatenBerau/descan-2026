<?php

namespace App\Filament\Resources\Publikasis\Pages;

use App\Filament\Resources\Publikasis\PublikasiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPublikasi extends EditRecord
{
    protected static string $resource = PublikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
