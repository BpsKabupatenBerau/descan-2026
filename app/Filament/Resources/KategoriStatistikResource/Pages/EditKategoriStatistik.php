<?php

namespace App\Filament\Resources\KategoriStatistikResource\Pages;

use App\Filament\Resources\KategoriStatistikResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriStatistik extends EditRecord
{
    protected static string $resource = KategoriStatistikResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
