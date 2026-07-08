<?php

namespace App\Filament\Resources\KategoriSpasials\Pages;

use App\Filament\Resources\KategoriSpasials\KategoriSpasialResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriSpasial extends EditRecord
{
    protected static string $resource = KategoriSpasialResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
