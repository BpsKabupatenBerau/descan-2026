<?php

namespace App\Filament\Resources\KategoriStatistiks\Pages;

use App\Filament\Resources\KategoriStatistiks\KategoriStatistikResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriStatistik extends EditRecord
{
    protected static string $resource = KategoriStatistikResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
